<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TemplateSuratController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\Api\WargaController;
use App\Http\Controllers\Api\BeritaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Backend API for Sistem Informasi Desa Simpur
|
*/

// Public
Route::post('/login', [AuthController::class, 'login']);
Route::get('/warga/check', [WargaController::class, 'check']); // Cek NIK Public
Route::get('/templates', [TemplateSuratController::class, 'index']); // Get All Templates
Route::get('/berita/list', [BeritaController::class, 'index']);      // Public News List

// Protected Routes (Sanctum)
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    // User / Warga
    Route::post('/pengajuan', [SuratController::class, 'store']); // Ajukan surat
    Route::get('/pengajuan/history', [SuratController::class, 'myHistory']);

    // Manajemen Surat
    Route::get('/surat/masuk', [SuratController::class, 'index']); // List all
    Route::get('/surat/{id}', [SuratController::class, 'show']);   // Detail
    Route::put('/surat/{id}/verify', [SuratController::class, 'verify']); // Admin verify
    Route::put('/surat/{id}/reject', [SuratController::class, 'reject']); // Admin reject
    Route::put('/surat/{id}/sign', [SuratController::class, 'sign']);     // Kades sign & generate number
    Route::get('/surat/{id}/pdf', [SuratController::class, 'download']);  // Admin download draft/final
    Route::delete('/surat/{id}', [SuratController::class, 'destroy']);    // Admin delete
    
    // Manajemen Warga
    Route::apiResource('warga', WargaController::class);

    // Manajemen Berita
    Route::apiResource('berita', BeritaController::class);
});
