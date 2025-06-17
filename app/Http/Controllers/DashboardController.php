<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        $totalRevenue = $orders->sum(function ($order) {
            $hargaSatuan = $order->jenisProduk->harga ?? 0;
            $total = $order->jumlah * $hargaSatuan;
            $diskon = $total * ($order->jenisProduk->diskon ?? 0);
            return $total - $diskon;
        });

        $totalOrder = $orders->sum('jumlah');

        // Rata-rata penjualan
        $averageSales = $totalOrder > 0 ? round($totalRevenue / $totalOrder) : 0;

        // Total diskon
        $totalDiskon = $orders->sum(function ($order) {
            $hargaSatuan = $order->jenisProduk->harga ?? 0;
            $total = $order->jumlah * $hargaSatuan;
            $diskon = $total * ($order->jenisProduk->diskon ?? 0);
            return $diskon;
        });

        return view('dashboard.index', compact('totalRevenue', 'totalOrder', 'averageSales', 'totalDiskon'));
    }
}