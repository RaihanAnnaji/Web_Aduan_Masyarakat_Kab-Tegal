<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // GET /berita — tampilkan semua berita
    public function index()
    {
        return Berita::all();
    }

    // GET /berita/{id} — tampilkan detail berita
    public function show($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        return response()->json($berita);
    }

    // POST /berita — tambah berita baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string', // bisa diganti jadi 'file' kalau upload file
            'content' => 'required|string',
        ]);

        $berita = Berita::create($validated);

        return response()->json([
            'message' => 'Berita berhasil ditambahkan',
            'data' => $berita,
        ], 201);
    }

    // PUT /berita/{id} — update berita
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'image' => 'nullable|string',
            'content' => 'sometimes|string',
        ]);

        $berita->update($validated);

        return response()->json([
            'message' => 'Berita berhasil diperbarui',
            'data' => $berita,
        ]);
    }

    // DELETE /berita/{id} — hapus berita
    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $berita->delete();

        return response()->json(['message' => 'Berita berhasil dihapus']);
    }
}
