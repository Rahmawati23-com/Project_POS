@extends('adminlte::page')

@section('title', 'Tambah Kategori Tokoh')

@section('content_header')
    <h1>Tambah Kategori</h1>
@stop

@section('content')
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@stop
