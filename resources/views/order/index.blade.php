@extends('adminlte::page')

@section('title', 'Order Produk')

@section('content_header')
    <h1>Order Produk</h1>
@stop

@section('content')
<div class="row">
    @foreach($produks as $produk)
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('storage/foto_produk/' . $produk->foto) }}" class="card-img-top" alt="{{ $produk->nama }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $produk->nama }}</h5>
                <p class="card-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                    <div class="form-group">
                        <input type="number" name="jumlah" value="1" class="form-control mb-2" min="1">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Pesan</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop
