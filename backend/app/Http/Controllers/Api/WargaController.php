<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Check Warga by NIK (Public)
     */
    public function check(Request $request)
    {
        $nik = trim($request->nik);
        \Illuminate\Support\Facades\Log::info('Cek NIK Request:', ['input' => $nik]);

        $request->validate([
            'nik' => 'required|numeric|digits_between:16,16'
        ]);

        $warga = \App\Models\Warga::where('nik', (string) $nik)->first();

        if (!$warga) {
             \Illuminate\Support\Facades\Log::warning('NIK Not Found:', ['nik' => $nik]);
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        \Illuminate\Support\Facades\Log::info('NIK Found:', ['warga' => $warga]);

        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $warga
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return simple list for now, or paginated
        return response()->json(\App\Models\Warga::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|unique:warga,nik|digits:16',
                'no_kk' => 'required|digits:16',
                'nama_lengkap' => 'required|string|max:150',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'required',
                'rt' => 'required',
                'rw' => 'required'
            ]);

            $warga = \App\Models\Warga::create($request->all());
            return response()->json($warga, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(\App\Models\Warga::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warga = \App\Models\Warga::findOrFail($id);
        $warga->update($request->all());
        return response()->json($warga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = \App\Models\Warga::findOrFail($id);
        $warga->delete();
        return response()->json(['message' => 'Data warga dihapus']);
    }
}
