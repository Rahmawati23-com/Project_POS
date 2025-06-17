@extends('adminlte::page')

@section('title', 'Jenis Produk')

@section('content_header')
    <h1>Jenis Produk</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($jenis_produks as $jenis)
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $jenis->nama }}</h5>
                        <a href="{{ route('produk.byJenis', $jenis->id) }}" class="btn btn-primary mt-2">Lihat Produk</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection