<?php

namespace App\Http\Controllers;

use App\Models\KategoriTokoh;
use App\Models\JenisProduk;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $kategoris = KategoriTokoh::all();
        $jenisProduks = JenisProduk::all();

        $recentOrders = Order::with('jenisProduk')->latest()->take(5)->get();

        return view('order.index', compact('kategoris', 'jenisProduks', 'recentOrders'));
    }

    public function store(Request $request)
    {
        Order::create([
            'kategori_id' => $request->kategori_id,
            'jenis_id' => $request->jenis_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
        ]);

        return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan.');
    }
}
