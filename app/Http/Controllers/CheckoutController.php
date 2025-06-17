<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\JenisProduk;
use App\Models\KategoriTokoh;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.jenis_id' => 'required|exists:jenis_produks,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total_harga_semua = 0;

            foreach ($request->items as $item) {
                $jenis = JenisProduk::findOrFail($item['jenis_id']);

                $jumlah = $item['jumlah'];
                $total = $jenis->harga * $jumlah;
                $total_harga_semua += $total;

                Order::create([
                    'kategori_id' => $jenis->kategori_id,
                    'jenis_id' => $jenis->id,
                    'jumlah' => $jumlah,
                    'total_harga' => $total,
                ]);
            }

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Checkout berhasil. Total Bayar: Rp ' . number_format($total_harga_semua));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }
}
