<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_tokoh' => 'required|string|max:255',
            'komentar' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimoni::create([
            'nama_tokoh' => $request->nama_tokoh,
            'komentar' => $request->komentar,
            'rating' => $request->rating,
            'produk_id' => $request->produk_id ?? null,
            'kategori_tokoh_id' => $request->kategori_tokoh_id ?? null,
            'tanggal' => now(),
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dikirim!');
    }
}