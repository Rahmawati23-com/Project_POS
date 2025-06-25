<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    public function index()
    {
        $jenis_produks = JenisProduk::all();
        return view('jenis_produk.index', compact('jenis_produks'));
    }

    public function create()
    {
        return view('jenis_produk.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|max:45']);
        JenisProduk::create($request->all());
        return redirect()->route('jenis-produk.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(JenisProduk $jenisProduk)
    {
        return view('jenis_produk.edit', compact('jenisProduk'));
    }

    public function update(Request $request, JenisProduk $jenisProduk)
    {
        $request->validate(['nama' => 'required|max:45']);
        $jenisProduk->update($request->all());
        return redirect()->route('jenis-produk.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(JenisProduk $jenisProduk)
    {
        $jenisProduk->delete();
        return redirect()->route('jenis-produk.index')->with('success', 'Data berhasil dihapus.');
    }
}