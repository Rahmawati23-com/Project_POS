@extends('adminlte::page')

@section('title', 'Tambah Jenis Produk')

@section('content_header')
    <h1>Tambah Jenis Produk</h1>
@endsection

@section('content')
    <form action="{{ route('jenis-produk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Jenis Produk</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <button class="btn btn-primary mt-2">Simpan</button>
        <a href="{{ route('jenis-produk.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
@endsection
