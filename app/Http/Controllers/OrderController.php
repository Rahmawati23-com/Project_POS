<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\KategoriTokoh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        
        $kategoris = KategoriTokoh::all();
        
        return view('order.index', compact('produks', 'kategoris'));
    }
}

class ProdukController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_produk'), $filename);
            $data['foto'] = $filename;
        }

        Produk::create($data);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        
        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($produk->foto && file_exists(public_path('foto_produk/' . $produk->foto))) {
                unlink(public_path('foto_produk/' . $produk->foto));
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto_produk'), $filename);
            $data['foto'] = $filename;
        }

        $produk->update($data);

        return redirect()->back()->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
        // Hapus foto jika ada
        if ($produk->foto && file_exists(public_path('foto_produk/' . $produk->foto))) {
            unlink(public_path('foto_produk/' . $produk->foto));
        }
        
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}