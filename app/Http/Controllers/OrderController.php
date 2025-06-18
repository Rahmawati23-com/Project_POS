<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('order.index', compact('produks'));
    }

    public function store(Request $request)
    {
        Order::create([
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'total_harga' => Produk::find($request->produk_id)->harga * $request->jumlah,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat.');
    }
}
