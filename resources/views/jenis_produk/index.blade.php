@extends('adminlte::page')

@section('title', 'Jenis Produk')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">
            <i class="fas fa-tags text-primary"></i> Jenis Produk
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jenis Produk</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Header dengan Statistik --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1">
                    <i class="fas fa-tags"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Jenis Produk</span>
                    <span class="info-box-number">{{ $jenis_produks->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Kelola Jenis Produk</h5>
                        <a href="{{ route('jenis-produk.create') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-plus"></i> Tambah Jenis Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search Bar (Optional) --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari jenis produk..." onkeyup="searchJenisProduk()">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-info" onclick="refreshPage()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    {{-- Grid Jenis Produk --}}
    @if($jenis_produks->isNotEmpty())
        <div class="row" id="produkGrid">
            @foreach($jenis_produks as $index => $jenis)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4 produk-item">
                    <div class="card card-outline card-primary h-100 shadow-sm hover-shadow">
                        {{-- Header Card dengan Nomor --}}
                        <div class="card-header bg-gradient-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-light">{{ $index + 1 }}</span>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool text-white" data-card-widget="maximize">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Gambar Produk --}}
                        <div class="card-img-container" style="height: 200px; overflow: hidden;">
                            @if($jenis->foto)
                                <img src="{{ asset('foto_produk/' . $jenis->foto) }}" 
                                     class="card-img-top product-image" 
                                     alt="{{ $jenis->nama }}" 
                                     style="height: 100%; width: 100%; object-fit: cover; transition: transform 0.3s;"
                                     onmouseover="this.style.transform='scale(1.05)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                     onerror="handleImageError(this, '{{ addslashes($jenis->nama) }}')">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-gradient-light" 
                                     style="height: 100%;">
                                    <div class="text-center">
                                        <i class="fas fa-image fa-4x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Tidak ada foto</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Body Card --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary font-weight-bold">{{ $jenis->nama }}</h5>
                            
                            {{-- Informasi Tambahan --}}
                            <div class="flex-grow-1">
                                @if(isset($jenis->harga) && $jenis->harga)
                                    <p class="card-text">
                                        <i class="fas fa-money-bill-wave text-success"></i>
                                        <span class="text-success font-weight-bold">
                                            Rp {{ number_format($jenis->harga, 0, ',', '.') }}
                                        </span>
                                    </p>
                                @endif
                                
                                @if(isset($jenis->kategori) && $jenis->kategori)
                                    <p class="card-text">
                                        <i class="fas fa-folder text-info"></i>
                                        <small class="text-muted">{{ $jenis->kategori->nama }}</small>
                                    </p>
                                @endif
                                
                                @if(isset($jenis->deskripsi) && $jenis->deskripsi)
                                    <p class="card-text">
                                        <small class="text-muted">{{ Str::limit($jenis->deskripsi, 100) }}</small>
                                    </p>
                                @endif

                                {{-- Status Badge --}}
                                @if(isset($jenis->status))
                                    <p class="card-text">
                                        @if($jenis->status == 'aktif')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-pause-circle"></i> Nonaktif
                                            </span>
                                        @endif
                                    </p>
                                @endif
                            </div>
                            
                            {{-- Action Buttons --}}
                            <div class="mt-auto pt-3">
                                {{-- Tombol Lihat Produk --}}
                                @if(Route::has('produk.byJenis'))
                        
                                @endif
                                
                                {{-- Tombol Admin --}}
                                <div class="btn-group btn-group-sm w-100" role="group">
                                    <a href="{{ route('jenis-produk.edit', $jenis->id) }}" 
                                       class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            data-delete-url="{{ route('jenis-produk.destroy', $jenis->id) }}"
                                            onclick="confirmDelete(this, '{{ addslashes($jenis->nama) }}')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Footer Card dengan Created Date --}}
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i>
                                Dibuat: {{ $jenis->created_at ? $jenis->created_at->format('d M Y') : '-' }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination jika menggunakan paginate() --}}
        @if(method_exists($jenis_produks, 'links'))
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $jenis_produks->links() }}
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- Empty State --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-tags fa-5x text-muted mb-4"></i>
                        <h4 class="text-muted">Belum Ada Jenis Produk</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan jenis produk pertama Anda.</p>
                        <a href="{{ route('jenis-produk.create') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-plus"></i> Tambah Jenis Produk Pertama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Form Hidden untuk Delete --}}
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('css')
    <style>
        .hover-shadow {
            transition: box-shadow 0.3s ease;
        }
        
        .hover-shadow:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        
        .card-img-container {
            position: relative;
            overflow: hidden;
        }
        
        .info-box:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        
        .btn-group-sm .btn {
            border-radius: 0;
        }
        
        .btn-group-sm .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        
        .btn-group-sm .btn:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
        
        .bg-gradient-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }

        .btn.loading {
            pointer-events: none;
        }

        .btn.loading::after {
            content: "";
            display: inline-block;
            width: 16px;
            height: 16px;
            margin-left: 8px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Search highlight */
        .search-highlight {
            background-color: yellow;
            font-weight: bold;
        }

        /* Hidden class for search */
        .hidden {
            display: none !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .btn-group-sm .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
            
            .info-box-number {
                font-size: 1.5rem;
            }
            
            .card-title {
                font-size: 1rem;
            }

            .card-img-container {
                height: 150px !important;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .bg-gradient-light {
                background: linear-gradient(135deg, #343a40 0%, #495057 100%);
            }
        }

        /* Animation for cards */
        .produk-item {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pulse animation for loading */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
@endsection

@section('js')
    <script>
        // Delete confirmation with improved error handling
        function confirmDelete(button, nama) {
            const deleteUrl = button.getAttribute('data-delete-url');
            
            if (!deleteUrl) {
                Swal.fire({
                    title: 'Error',
                    text: 'URL penghapusan tidak ditemukan',
                    icon: 'error'
                });
                return;
            }
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Yakin ingin menghapus jenis produk "${nama}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    button.classList.add('loading');
                    button.disabled = true;
                    
                    const form = document.getElementById('deleteForm');
                    form.action = deleteUrl;
                    
                    // Add hidden input for additional security if needed
                    const tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = '_token';
                    tokenInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    form.appendChild(tokenInput);
                    
                    form.submit();
                }
            });
        }

        function handleImageError(img, productName) {
            console.log('Image failed to load:', img.src);
            
            const container = img.closest('.card-img-container');
            container.innerHTML = `
                <div class="card-img-top d-flex align-items-center justify-content-center bg-gradient-light" style="height: 100%;">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-2"></i>
                        <p class="text-muted mb-1"><strong>${productName}</strong></p>
                        <small class="text-muted">Gambar tidak dapat dimuat</small>
                        <button class="btn btn-sm btn-outline-primary mt-2" onclick="retryLoadImage(this, '${img.src}', '${productName}')">
                            <i class="fas fa-redo"></i> Coba Lagi
                        </button>
                    </div>
                </div>
            `;
        }

        // Retry loading image
        function retryLoadImage(button, originalSrc, productName) {
            const container = button.closest('.card-img-container');
            container.innerHTML = `
                <div class="card-img-top d-flex align-items-center justify-content-center bg-gradient-light" style="height: 100%;">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="text-muted mt-2">Memuat ulang gambar...</p>
                    </div>
                </div>
            `;
            
            setTimeout(() => {
                const img = new Image();
                img.onload = function() {
                    container.innerHTML = `
                        <img src="${this.src}" 
                             class="card-img-top product-image" 
                             alt="${productName}" 
                             style="height: 100%; width: 100%; object-fit: cover; transition: transform 0.3s;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                    `;
                };
                img.onerror = function() {
                    container.innerHTML = `
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-gradient-light" style="height: 100%;">
                            <div class="text-center">
                                <i class="fas fa-times-circle fa-3x text-danger mb-2"></i>
                                <p class="text-muted mb-1"><strong>${productName}</strong></p>
                                <small class="text-muted">Gambar masih tidak dapat dimuat</small>
                            </div>
                        </div>
                    `;
                };
                img.src = originalSrc + '?t=' + new Date().getTime(); // Add timestamp to bypass cache
            }, 1000);
        }

        // Search functionality
        function searchJenisProduk() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.produk-item');
            let visibleCount = 0;
            
            cards.forEach(card => {
                const title = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
                const description = card.querySelector('.card-text')?.textContent.toLowerCase() || '';
                
                if (searchTerm === '' || title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                    card.classList.add('hidden');
                }
            });

            const noResultsMsg = document.getElementById('noResultsMessage');
            if (visibleCount === 0 && searchTerm !== '') {
                if (!noResultsMsg) {
                    const grid = document.getElementById('produkGrid');
                    const noResults = document.createElement('div');
                    noResults.id = 'noResultsMessage';
                    noResults.className = 'col-12 text-center py-5';
                    noResults.innerHTML = `
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada hasil ditemukan</h5>
                        <p class="text-muted">Coba dengan kata kunci yang berbeda</p>
                    `;
                    grid.appendChild(noResults);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }

        // Clear search
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            searchJenisProduk();
        }

        // Refresh page function
        function refreshPage() {
            window.location.reload();
        }

        // Print function
        function printPage() {
            window.print();
        }

        // Export data function (basic)
        function exportData() {
            Swal.fire({
                title: 'Export Data',
                text: 'Fitur export sedang dalam pengembangan',
                icon: 'info'
            });
        }

        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            $('.alert .btn-close').on('click', function() {
                $(this).closest('.alert').fadeOut('fast');
            });

            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            $('form').on('submit', function() {
                const submitBtn = $(this).find('button[type="submit"], input[type="submit"]');
                submitBtn.addClass('loading').prop('disabled', true);
            });

            setTimeout(function() {
                $('.product-image').each(function() {
                    if (this.naturalWidth === 0) {
                        this.onerror();
                    }
                });
            }, 2000);

            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            $('#searchInput').on('keypress', function(e) {
                if (e.which == 13) {
                    searchJenisProduk();
                }
            });

            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                                observer.unobserve(img);
                            }
                        }
                    });
                });
                
                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                window.location.href = "{{ route('jenis-produk.create') }}";
            }
            
            if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                refreshPage();
            }

            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                document.getElementById('searchInput').focus();
            }

            if (e.key === 'Escape') {
                clearSearch();
            }
        });

        // Performance monitoring
        window.addEventListener('load', function() {
            console.log('Page loaded in:', performance.now(), 'ms');
        });
    </script>
@endsection