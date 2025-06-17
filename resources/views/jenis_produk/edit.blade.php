@extends('adminlte::page')

@section('title', 'Edit Jenis Produk')

@section('content_header')
    <h1>Edit Jenis Produk</h1>
@endsection

@section('content')
    <form action="{{ route('jenis-produk.update', $jenisProduk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Jenis Produk</label>
            <input type="text" name="nama" value="{{ $jenisProduk->nama }}" class="form-control" required>
        </div>
        <button class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('jenis-produk.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </form>
@endsection
