@extends('adminlte::page')

@section('title', 'Jenis Produk')

@section('content_header')
    <h1>Jenis Produk</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        {{-- Tombol Tambah Jenis Produk Baru --}}
    <div class="row mt-3">
        <div class="col-12">
            <a href="{{ route('jenis-produk.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Jenis Produk Baru
            </a>
        </div>
    </div>
    <br></br>
    <div class="row">
        @foreach($jenis_produks as $jenis)
            <div class="col-md-3 mb-3">
                <div class="card text-center shadow h-100">
                    {{-- Tampilkan foto jika ada --}}
                    @if($jenis->foto)
                        <img src="{{ asset('storage/foto_produk/' . $jenis->foto) }}" class="card-img-top" alt="{{ $jenis->nama }}" style="height: 150px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $jenis->nama }}</h5>
                        
                        {{-- Tampilkan harga jika ada --}}
                        @if($jenis->harga)
                            <p class="card-text text-success font-weight-bold">
                                Rp {{ number_format($jenis->harga, 0, ',', '.') }}
                            </p>
                        @endif
                        
                        {{-- Tampilkan kategori jika ada relasi --}}
                        @if($jenis->kategori)
                            <small class="text-muted mb-2">Kategori: {{ $jenis->kategori->nama }}</small>
                        @endif
                        
                        <div class="mt-auto">
                            <a href="{{ route('produk.byJenis', $jenis->id) }}" class="btn btn-primary">Lihat Produk</a>
                            {{-- Tombol tambahan untuk admin --}}
                            <div class="btn-group mt-2" role="group">
                                <a href="{{ route('jenis-produk.edit', $jenis->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('jenis-produk.destroy', $jenis->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection