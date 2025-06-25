<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\KategoriTokohController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('produk', ProdukController::class);
    Route::resource('jenis-produk', JenisProdukController::class);
    Route::resource('kategori-tokoh', KategoriTokohController::class);
    Route::resource('order', OrderController::class);
    Route::resource('kategori', KategoriTokohController::class);
    Route::resource('testimoni', TestimoniController::class);
});

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/produk/by-jenis/{id}', [ProdukController::class, 'byJenis'])->name('produk.byJenis');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
// Route::put('/produk/{product}', [ProdukController::class, 'update'])->name('produk.update');
// Route::delete('/produk/{product}', [ProdukController::class, 'destroy'])->name('produk.destroy');

require __DIR__.'/auth.php';