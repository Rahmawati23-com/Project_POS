
@extends('adminlte::page')

@section('title', 'Order Produk')

@section('content_header')
    <h1>Order Produk</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Button untuk tambah produk -->
    <div class="row mb-3">
        <div class="col-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus"></i> Tambah Produk
            </button>
        </div>
    </div>

    <!-- Grid produk -->
    <div class="row">
        @foreach($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <!-- Gambar produk -->
                <div class="card-img-top text-center bg-light p-2" style="height: 200px;">
                    @if($produk->foto)
                        <img src="{{ asset('foto_produk/' . $produk->foto) }}"
                            class="img-fluid"
                            style="max-height: 180px; object-fit: contain;"
                            alt="{{ $produk->nama }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold">{{ $produk->nama }}</h5>
                    @if($produk->deskripsi)
                        <p class="card-text text-muted small">{{ Str::limit($produk->deskripsi, 100) }}</p>
                    @endif
                    <h6 class="text-primary font-weight-bold mb-2">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </h6>
                    <p class="text-muted mb-2">
                        Stok: <strong>{{ $produk->stok }}</strong>
                    </p>
                    <div class="mt-auto">
                        <button type="button" class="btn btn-primary btn-block add-to-cart-btn"
                            data-id="{{ $produk->id }}"
                            data-nama="{{ $produk->nama }}"
                            data-harga="{{ $produk->harga }}">
                            <i class="fas fa-shopping-cart"></i> Pesan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($produks->isEmpty())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i>
                Belum ada produk yang tersedia. Silakan tambah produk baru.
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Sidebar Keranjang -->
<div id="cartSidebar" class="cart-sidebar bg-white shadow p-4" style="position: fixed; top: 0; right: -400px; width: 350px; height: 100%; z-index: 1050; transition: right 0.3s;">
    <h5 class="mb-4">Keranjang</h5>
    <div id="cartItems"></div>
    <hr>
    <h6>Total: Rp <span id="cartTotal">0</span></h6>
    <button class="btn btn-success btn-block mt-3" onclick="checkoutCart()">Bayar Sekarang</button>
</div>

<!-- Modal Tambah Produk -->
@include('partials.modal_tambah_produk')
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .cart-sidebar.open {
        right: 0 !important;
    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
let cart = [];

function updateCartUI() {
    let cartItems = $('#cartItems');
    let cartTotal = 0;
    cartItems.empty();

    cart.forEach(item => {
        cartItems.append(`
            <div class="mb-2">
                <strong>${item.nama}</strong><br>
                Qty: ${item.qty} x Rp ${item.harga.toLocaleString()}<br>
                <small>Total: Rp ${(item.qty * item.harga).toLocaleString()}</small>
            </div>
        `);
        cartTotal += item.qty * item.harga;
    });

    $('#cartTotal').text(cartTotal.toLocaleString());
}

function openCartSidebar() {
    $('#cartSidebar').addClass('open');
}

function checkoutCart() {
    alert('Bayar Sekarang belum diimplementasikan.');
}

$(document).on('click', '.add-to-cart-btn', function() {
    const id = $(this).data('id');
    const nama = $(this).data('nama');
    const harga = parseInt($(this).data('harga'));

    let existing = cart.find(item => item.id === id);
    if (existing) {
        existing.qty++;
    } else {
        cart.push({ id, nama, harga, qty: 1 });
    }

    updateCartUI();
    openCartSidebar();
});
</script>
@stop
