@extends('adminlte::page')

@section('title', 'Point of Sale')

@section('content_header')
    <h1>Point of Sale</h1>
@endsection

@section('content')
<div class="row">
    {{-- Produk Section (Kiri) --}}
    <div class="col-md-8">
        <div class="row">
            @foreach($jenisProduks as $produk)
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('storage/foto_produk/' . $produk->foto) }}" class="card-img-top" alt="{{ $produk->nama }}" style="height: 120px; object-fit: cover;">
                    <div class="card-body p-2">
                        <h5 class="card-title mb-1" style="font-size: 16px;">{{ $produk->nama }}</h5>
                        <p class="card-text mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis_id" value="{{ $produk->id }}">
                            <input type="hidden" name="kategori_id" value="{{ $produk->kategori_id }}">
                            <input type="hidden" name="jumlah" value="1">
                            <input type="hidden" name="total_harga" value="{{ $produk->harga }}">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Recent Orders Section (Kanan) --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Recent Orders</h5>
            </div>
            <div class="card-body p-2">
                <ul class="list-group">
                    @forelse($recentOrders as $order)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $order->jenisProduk->nama }}</strong><br>
                            <small>Qty: {{ $order->jumlah }}</small>
                        </div>
                        <span class="badge bg-success">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                    </li>
                    @empty
                    <li class="list-group-item">Belum ada order.</li>
                    @endforelse
                </ul>
                <hr>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
