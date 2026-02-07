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
        $validated = $request->validate([
            'judul' => 'required|string',
            'link' => 'required|url',
            'sumber' => 'nullable|string',
            'gambar' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);
 
        $berita = Berita::create($validated);
        return response()->json($berita, 201);
    }

    public function show(string $id)
    {
        return response()->json(Berita::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'link' => 'required|url',
        ]);
 
        $berita = Berita::findOrFail($id);
        $berita->update($validated);
        return response()->json($berita);
    }

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return response()->json(['message' => 'Berita dihapus']);
    }
}
