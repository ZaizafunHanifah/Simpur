<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\NomorSurat;
use App\Models\TemplateSurat;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    /**
     * List Surat (Admin/Public History)
     */
    public function index(Request $request)
    {
        // Jika Admin/Perangkat Desa, tampilkan semua sesuai filter/status
        if ($request->user()->tokenCan('role:admin') || $request->user()->tokenCan('role:admin')) {
             $query = Surat::with(['warga', 'templateSurat'])->latest();
             
             if ($request->has('status')) {
                 $query->where('status', $request->status);
             }
             
             return response()->json($query->get());
        }
        
        // Jika Warga, tampilkan milik sendiri
        return response()->json(['message' => 'Unauthorized access to list'], 403);
    }
    
    /**
     * Detail Surat
     */
    public function show($id)
    {
        $surat = Surat::with(['warga', 'templateSurat'])->findOrFail($id);
        return response()->json($surat);
    }

    /**
     * Admin: Verifikasi Surat
     */
    public function verify(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        
        if ($surat->status !== 'diajukan') {
            return response()->json(['message' => 'Surat tidak dalam status diajukan'], 400);
        }

        $surat->update([
            'status' => 'diverifikasi',
            'verified_by' => $request->user()->id
        ]);

        return response()->json(['message' => 'Surat berhasil diverifikasi']);
    }

    /**
     * Admin: Tolak Surat
     */
    public function reject(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->update([
            'status' => 'ditolak',
            'verified_by' => $request->user()->id // or add rejected_by column if needed
        ]);
        return response()->json(['message' => 'Surat ditolak']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:template_surat,id',
            'data_input' => 'required|array'
        ]);

        $dataInput = $request->data_input;
        $nik = $dataInput['nik'] ?? null;
        $wargaId = null;

        if ($nik) {
            $warga = \App\Models\Warga::where('nik', $nik)->first();
            if ($warga) {
                $wargaId = $warga->id;
            }
        }

        // Fallback to authenticated user if no NIK or NIK not found
        if (!$wargaId) {
            $user = $request->user();
            if ($user && $user->warga) {
                $wargaId = $user->warga->id;
            } else {
                return response()->json(['message' => 'Data warga tidak ditemukan berdasarkan NIK yang dimasukkan.'], 422);
            }
        }

        $surat = Surat::create([
            'uuid' => Str::uuid(),
            'warga_id' => $wargaId,
            'template_surat_id' => $request->template_id,
            'status' => 'diajukan',
            'data_input' => json_encode($dataInput),
        ]);

        return response()->json(['message' => 'Surat berhasil diajukan', 'data' => $surat], 201);
    }

    /**
     * Kades: Tanda Tangan & Finalisasi
     */
    public function sign(Request $request, $id)
    {
        try {
            $surat = Surat::with(['warga', 'templateSurat'])->findOrFail($id);

            // Perkuat pengecekan status (beberapa mungkin pakai label beda)
            if (!in_array($surat->status, ['diverifikasi', 'diproses', 'menunggu_ttd'])) {
                return response()->json(['message' => 'Status surat saat ini (' . $surat->status . ') tidak bisa langsung diselesaikan.'], 400);
            }

            // 1. Generate Nomor Surat
            $nomorBaru = NomorSurat::generateNextNumber();

            // 2. Update Record first so PDF generation sees the new data
            $surat->update([
                'status' => 'selesai',
                'nomor_surat_final' => $nomorBaru,
                'signed_by' => $request->user()->id,
                'signed_at' => now(),
                'penandatangan_nama' => $request->penandatangan_nama,
                'penandatangan_jabatan' => $request->penandatangan_jabatan,
            ]);

            // 3. Generate PDF
            try {
                $pdfPath = $this->generatePdf($surat, $nomorBaru);
                $surat->update(['file_path' => $pdfPath]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal membuat file PDF: ' . $e->getMessage()], 500);
            }

            return response()->json(['message' => 'Surat ditandatangani dan selesai.', 'nomor' => $nomorBaru]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Preview/Download PDF Draft
     */
    public function download(Request $request, $id)
    {
        $surat = Surat::with(['warga', 'templateSurat'])->findOrFail($id);
        
        // Allow Preview Overrides
        if ($request->has('penandatangan_nama')) {
            $surat->penandatangan_nama = $request->penandatangan_nama;
        }
        if ($request->has('penandatangan_jabatan')) {
            $surat->penandatangan_jabatan = $request->penandatangan_jabatan;
        }

        // Generate nomor sementara (Peek next number if not signed yet)
        $nomorSurat = $surat->nomor_surat_final ?? NomorSurat::peekNextNumber();

        $data = [
            'surat' => $surat,
            'warga' => $surat->warga,
            'nomor' => $nomorSurat,
            'konten' => $this->parseTemplate($surat)
        ];

        $pdf = Pdf::loadView('pdf.template_resmi', $data);
        return $pdf->download('Surat_'.$surat->warga->nama_lengkap.'.pdf');
    }

    private function generatePdf($surat, $nomorSurat)
    {
        // Data to view
        $data = [
            'surat' => $surat,
            'warga' => $surat->warga,
            'nomor' => $nomorSurat,
            'konten' => $this->parseTemplate($surat)
        ];

        // Load View (Shared or internal)
        // In this split architecture, Backend generates PDF locally to store or return stream
        $pdf = Pdf::loadView('pdf.template_resmi', $data);
        
        $filename = 'surat_' . $surat->uuid . '.pdf';
        Storage::put('public/surat/' . $filename, $pdf->output());

        return $filename;
    }

    private function parseTemplate($surat)
    {
        $text = $surat->templateSurat->konten_template;
        $warga = $surat->warga;
        $input = json_decode($surat->data_input);

        $replacements = [
            '{{nama}}' => $warga->nama_lengkap,
            '{{nik}}' => $warga->nik,
            '{{alamat}}' => $warga->alamat,
            '{{keperluan}}' => $input->keperluan ?? '-',
            '{{ttd_nama}}' => $surat->penandatangan_nama ?? '(Belum Ditandatangani)',
            '{{ttd_jabatan}}' => $surat->penandatangan_jabatan ?? 'Kepala Desa Simpur',
            '{{nomor_surat}}' => $surat->nomor_surat_final ?? NomorSurat::peekNextNumber(),
            '{{tanggal_surat}}' => $surat->signed_at ? \Carbon\Carbon::parse($surat->signed_at)->translatedFormat('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y')
        ];

        foreach ($replacements as $key => $val) {
            $text = str_replace($key, $val, $text);
        }
        return $text;
    }
    public function myHistory(Request $request)
    {
        $surat = Surat::with(['templateSurat', 'warga'])
                    ->where('warga_id', $request->user()->warga->id)
                    ->latest()
                    ->get();
                    
        return response()->json($surat);
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return response()->json(['message' => 'Surat berhasil dihapus']);
    }
}
