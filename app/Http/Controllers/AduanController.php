<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class AduanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'isi' => 'required|string',
        ]);

        $aduan = Aduan::create($validated);

        return response()->json([
            'message' => 'Aduan berhasil dikirim',
            'data' => $aduan
        ], 201);
    }

    public function index()
    {
        return Aduan::latest()->get(); // opsional, untuk admin
    }
}
