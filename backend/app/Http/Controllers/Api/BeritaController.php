<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        return response()->json(Berita::latest()->get());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string',
                'link' => 'required|url',
                'sumber' => 'nullable|string',
                'gambar' => 'nullable|string',
                'kategori' => 'nullable|string',
                'deskripsi' => 'nullable|string',
            ]);
    
            $berita = Berita::create($validated);
            return response()->json($berita, 201);
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

    public function show(string $id)
    {
        return response()->json(Berita::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string',
                'link' => 'required|url',
                'sumber' => 'nullable|string',
                'gambar' => 'nullable|string',
                'kategori' => 'nullable|string',
                'deskripsi' => 'nullable|string',
            ]);
    
            $berita = Berita::findOrFail($id);
            $berita->update($validated);
            return response()->json($berita);
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

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return response()->json(['message' => 'Berita dihapus']);
    }
}
