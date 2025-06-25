<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\KategoriTokohController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('produk', ProdukController::class);
    Route::resource('jenis-produk', JenisProdukController::class);
    Route::resource('kategori-tokoh', KategoriTokohController::class);
    Route::resource('kategori', KategoriTokohController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/produk/by-jenis/{id}', [ProdukController::class, 'byJenis'])->name('produk.byJenis');
});

Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::resource('order', OrderController::class)->only(['index', 'store']);
    Route::resource('testimoni', TestimoniController::class)->only(['index', 'store']);
});

require __DIR__.'/auth.php';
