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
    Route::resource('testimoni', TestimoniController::class);
});

Route::resource('order', \App\Http\Controllers\OrderController::class)->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/produk/by-jenis/{id}', [ProdukController::class, 'byJenis'])->name('produk.byJenis');
Route::resource('jenis-produk', JenisProdukController::class);

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::resource('kategori', KategoriTokohController::class);

require __DIR__.'/auth.php';
