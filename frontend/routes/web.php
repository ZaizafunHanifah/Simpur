<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

// -- Authentication Routes --
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    try {
        $response = Http::timeout(30)
            ->acceptJson()
            ->post(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        return back()->with('error', 'Koneksi ke server gagal (Timeout). Pastikan Backend berjalan di port 8000.');
    }

    if ($response->successful()) {
        $token = $response->json()['token'];
        session(['api_token' => $token]);
        return redirect()->route('dashboard'); // Redirect to dashboard
    } else {
        // Debugging
        $errorMsg = 'Login gagal. ';
        if ($response->status() === 422) {
            $errorMsg .= 'Validasi Gagal.';
        } elseif ($response->status() === 401) {
            $errorMsg .= 'Password/Email Salah.';
        } else {
            $errorMsg .= 'Server Error (' . $response->status() . ').';
        }
        return back()->with('error', $errorMsg);
    }
})->name('login.post');

Route::get('/logout', function () {
    if(session('api_token')) {
        Http::withToken(session('api_token'))->post(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/logout');
    }
    session()->forget('api_token');
    return redirect('/');
})->name('logout');


use App\Http\Middleware\EnsureApiToken;

// -- Admin Routes (Protected) --
Route::group(['middleware' => [EnsureApiToken::class]], function () {
    
    Route::get('/dashboard', function () {
        // Fetch Real Counts
        $token = session('api_token');
        $headers = ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token];
        
        $responseSurat = Http::withHeaders($headers)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/masuk');
        $responseWarga = Http::withHeaders($headers)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/warga');
        
        $suratCount = 0;
        $statusCounts = [
            'diajukan' => 0,
            'diverifikasi' => 0,
            'selesai' => 0,
            'ditolak' => 0
        ];

        if($responseSurat->successful()) {
            $suratData = collect($responseSurat->json() ?? []);
            $suratCount = $suratData->count();
            $statusCounts['diajukan'] = $suratData->where('status', 'diajukan')->count();
            $statusCounts['diverifikasi'] = $suratData->where('status', 'diverifikasi')->count();
            $statusCounts['selesai'] = $suratData->where('status', 'selesai')->count();
            $statusCounts['ditolak'] = $suratData->where('status', 'ditolak')->count();
        }

        $wargaData = $responseWarga->json() ?? [];
        $wargaCount = $responseWarga->successful() ? ($wargaData['total'] ?? count($wargaData['data'] ?? (is_array($wargaData) ? $wargaData : []))) : 0; 

        return view('dashboard', compact('suratCount', 'wargaCount', 'statusCounts'));
    })->name('dashboard');

    // Admin Surat Routes
    Route::get('/admin/surat', function () {
        $token = session('api_token');
        $response = Http::withToken($token)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/masuk');
        $surat = $response->successful() ? ($response->json() ?? []) : [];
        return view('admin.surat.index', compact('surat'));
    })->name('admin.surat.index');

    Route::get('/admin/surat/{id}', function ($id) {
        $token = session('api_token');
        $response = Http::withToken($token)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/' . $id);
        
        if(!$response->successful()) return redirect()->back()->with('error', 'Data tidak ditemukan');
        
        $surat = $response->json();
        return view('admin.surat.show', compact('surat'));
    })->name('admin.surat.show');

    Route::get('/admin/surat/{id}/download', function (Request $request, $id) {
        $token = session('api_token');
        // Fetch raw PDF content with query params (signatory overrides)
        $response = Http::withToken($token)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/' . $id . '/pdf', $request->query());
        
        if ($response->successful()) {
            return response($response->body())
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="surat_export.pdf"');
        }
        return back()->with('error', 'Gagal download PDF: ' . $response->status());
    })->name('admin.surat.download');

    // Actions
    Route::put('/admin/surat/{id}/verify', function ($id) {
        $response = Http::withToken(session('api_token'))->put(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/'.$id.'/verify');
        return back()->with($response->successful() ? 'success' : 'error', 'Status Verifikasi Diperbarui');
    })->name('admin.surat.verify');

    Route::put('/admin/surat/{id}/reject', function ($id) {
        $response = Http::withToken(session('api_token'))->put(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/'.$id.'/reject');
        return back()->with($response->successful() ? 'success' : 'error', 'Surat Ditolak');
    })->name('admin.surat.reject');
    
    Route::put('/admin/surat/{id}/sign', function (Request $request, $id) {
        $response = Http::withToken(session('api_token'))->put(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/'.$id.'/sign', [
            'penandatangan_nama' => $request->penandatangan_nama,
            'penandatangan_jabatan' => $request->penandatangan_jabatan
        ]);
        
        if ($response->successful()) {
            return back()->with('success', 'Status Berhasil Diperbarui: Selesai & Siap Diambil');
        } else {
            $msg = $response->json()['message'] ?? 'Gagal memperbarui status surat.';
            return back()->with('error', $msg);
        }
    })->name('admin.surat.sign');

    Route::delete('/admin/surat/{id}', function ($id) {
        $response = Http::withToken(session('api_token'))->delete(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/surat/' . $id);
        
        if ($response->successful()) {
            return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dihapus');
        } else {
            return back()->with('error', 'Gagal menghapus surat: ' . $response->body());
        }
    })->name('admin.surat.destroy');

    // -- ADMIN WARGA MANAGEMENT ROUTES --
    Route::get('/admin/warga', function () {
        $token = session('api_token');
        $response = Http::withToken($token)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/warga');
        $json = $response->json() ?? [];
        $warga = $response->successful() ? ($json['data'] ?? (is_array($json) ? $json : [])) : [];
        return view('admin.warga.index', compact('warga'));
    })->name('admin.warga.index');

    Route::get('/admin/warga/create', function () {
        return view('admin.warga.create');
    })->name('admin.warga.create');

    Route::post('/admin/warga', function (Request $request) {
        $token = session('api_token');
        $response = Http::withToken($token)->post(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/warga', $request->all());
        
        if ($response->successful()) {
            return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil ditambahkan');
        } else {
            $data = $response->json();
            $msg = $data['message'] ?? 'Gagal menambah warga.';
            if(isset($data['errors'])) {
                $errorList = collect($data['errors'])->flatten()->implode(', ');
                $msg .= ' (' . $errorList . ')';
            }
            return back()->with('error', $msg)->withInput();
        }
    })->name('admin.warga.store');

    Route::delete('/admin/warga/{id}', function ($id) {
        $token = session('api_token');
        $response = Http::withToken($token)->delete(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/warga/' . $id);
        
        return back()->with($response->successful() ? 'success' : 'error', 'Data Warga dihapus');
    })->name('admin.warga.destroy');

    // -- ADMIN BERITA MANAGEMENT ROUTES --
    Route::get('/admin/berita', function () {
        $token = session('api_token');
        $response = Http::withToken($token)->get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/berita');
        $berita = $response->successful() ? $response->json() : [];
        return view('admin.berita.index', compact('berita'));
    })->name('admin.berita.index');

    Route::get('/admin/berita/create', function () {
        return view('admin.berita.create');
    })->name('admin.berita.create');

    Route::post('/admin/berita', function (Request $request) {
        $token = session('api_token');
        $response = Http::withToken($token)->post(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/berita', $request->all());
        
        if ($response->successful()) {
            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diinput');
        } else {
            return back()->with('error', 'Gagal input berita: ' . $response->body())->withInput();
        }
    })->name('admin.berita.store');

    Route::delete('/admin/berita/{id}', function ($id) {
        $token = session('api_token');
        $response = Http::withToken($token)->delete(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/berita/' . $id);
        
        return back()->with($response->successful() ? 'success' : 'error', 'Berita dihapus');
    })->name('admin.berita.destroy');
});


// -- Public / Warga Routes --
Route::get('/profil-desa', function () {
    return view('profil.desa');
})->name('profil.desa');

Route::get('/berita', function () {
    try {
        $response = Http::get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/berita/list');
        $berita = $response->successful() ? ($response->json() ?? []) : [];
    } catch (\Exception $e) {
        $berita = [];
    }
    return view('berita.index', compact('berita'));
})->name('berita.index');

Route::get('/pengajuan', function () {
    // Fetch Templates form API
    try {
        $response = Http::get(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/templates');
        $templates = $response->successful() ? $response->json() : [];
        // Convert array to object to match view expectation
        $templates = array_map(function($t) { return (object)$t; }, $templates);
    } catch (\Exception $e) {
        $templates = [];
    }

    return view('warga.pengajuan', compact('templates'));
})->name('pengajuan.create');

Route::post('/pengajuan', function (Request $request) {
    // 1. Get Warga Token (Auto Login for Demo)
    // In real app, Warga should login first. Here we use the dummy credentials.
    try {
        $login = Http::post(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/login', [
            'email' => 'warga@simpur.desa.id',
            'password' => 'password',
        ]);
        
        if ($login->failed()) {
            return back()->with('error', 'Gagal otentikasi sistem.');
        }

        $token = $login->json()['token'];

        // 2. Submit Authorization
        $response = Http::withToken($token)
            ->acceptJson()
            ->post(env('BACKEND_URL', 'http://127.0.0.1:8000') . '/api/pengajuan', [
                'template_id' => $request->template_id,
                'data_input' => [
                    'nik' => $request->input('data_input.nik'), // ensure this matches form structure
                    'keperluan' => $request->keperluan
                ]
            ]);
            
        if ($response->successful()) {
            return redirect()->route('pengajuan.create')->with('success', 'Surat BERHASIL diajukan! Silakan hubungi Admin Desa untuk proses selanjutnya.');
        } else {
             return back()->with('error', 'Gagal mengajukan: ' . $response->body());
        }

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
    }
})->name('pengajuan.store');
