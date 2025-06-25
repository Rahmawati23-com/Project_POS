<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\KategoriTokoh;
use App\Models\Produk;
use App\Models\JenisProduk; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function create()
    {
        $jenisProduks = JenisProduk::all();
        $kategoris = KategoriTokoh::all();

        dd([
            'jenis_produks_count' => $jenisProduks->count(),
            'jenis_produks_data' => $jenisProduks->toArray(),
            'kategoris_count' => $kategoris->count()
        ]);
        
        return view('produk.create', compact('jenisProduks', 'kategoris'));
    }

    // TAMBAHKAN METHOD EDIT INI
    public function edit(Produk $product)
    {
        $jenisProduks = JenisProduk::all();
        $kategoris = KategoriTokoh::all();
        
        return view('produk.edit', compact('product', 'jenisProduks', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'kategori_id' => 'nullable|exists:kategori_tokohs,id',
        'jenis_produk_id' => 'required|exists:jenis_produks,id', // TAMBAHKAN INI
        'stok' => 'nullable|integer|min:0',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // 2MB max
    ]);

        $data = $request->all();
        
        $lastProduct = Produk::latest('id')->first();
        $nextNumber = $lastProduct ? (int)substr($lastProduct->kode, 3) + 1 : 1;
        $data['kode'] = 'BRG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');
            $data['foto'] = $path;
        }

        $data['stok'] = $data['stok'] ?? 0;
        $data['min_stok'] = 0;
        $data['rating'] = null;

        Produk::create($data);

        return redirect()->route('order.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, Produk $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kategori_id' => 'nullable|exists:kategori_tokohs,id',
            'jenis_produk_id' => 'required|exists:jenis_produks,id', // TAMBAHKAN INI JUGA
            'stok' => 'nullable|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products', $filename, 'public');
            $data['foto'] = $path;
        }

        $product->update($data);

        return redirect()->route('order.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $product)
    {
        // Hapus foto jika ada
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('order.index')->with('success', 'Produk berhasil dihapus!');
    }
}