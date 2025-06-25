<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();
    
    $data = [
        'isAdmin' => $user && $user->role === 'admin',
        'totalRevenue' => 0,
        'totalOrders' => 0,
        'avgPurchase' => 0,
        'totalDiscount' => 0,
        'myOrders' => 0,
        'mySpending' => 0,
        'myDiscount' => 0,
        'memberSince' => '2024',
        'topProducts' => [],
        'recentOrders' => [],
        'favoriteProducts' => [],
        'salesData' => [10, 20, 30, 40, 50, 60, 70],
        'paymentData' => [60, 25, 15]
    ];
    
    return view('dashboard.index', compact('data'));
}
}