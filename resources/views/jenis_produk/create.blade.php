@extends('adminlte::page')

@section('title', 'Tambah Jenis Produk')

@section('content_header')
    <div class="content-header-modern">
        <h1 class="header-title">
            <i class="fas fa-plus-circle text-primary"></i>
            Tambah Jenis Produk
        </h1>
        <p class="header-subtitle">Buat jenis produk baru dengan foto</p>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card modern-card">
                <div class="card-header modern-header">
                    <h3 class="card-title">
                        <i class="fas fa-box-open mr-2"></i>
                        Form Tambah Jenis Produk
                    </h3>
                </div>
                
                <div class="card-body modern-body">
                    <form action="{{ route('jenis-produk.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
                        @csrf
                        
                        <!-- Photo Upload Section -->
                        <div class="photo-upload-section mb-4">
                            <label class="form-label modern-label">
                                <i class="fas fa-camera mr-2"></i>
                                Foto Jenis Produk
                            </label>
                            
                            <div class="photo-upload-container">
                                <div class="photo-preview" id="photoPreview">
                                    <div class="photo-placeholder">
                                        <i class="fas fa-image fa-3x"></i>
                                        <p>Klik untuk menambahkan foto</p>
                                        <span class="upload-hint">JPG, PNG atau GIF (Max 2MB)</span>
                                    </div>
                                </div>
                                
                                <input type="file" name="foto" id="fotoInput" accept="image/*" class="d-none">
                                
                                <div class="photo-actions mt-3">
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('fotoInput').click()">
                                        <i class="fas fa-upload mr-1"></i>
                                        Pilih Foto
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm ml-2" id="removePhoto" style="display: none;">
                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Name Input Section -->
                        <div class="form-group modern-form-group">
                            <label class="form-label modern-label">
                                <i class="fas fa-tag mr-2"></i>
                                Nama Jenis Produk <span class="text-danger">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       name="nama" 
                                       value="{{ old('nama') }}" 
                                       class="form-control modern-input @error('nama') is-invalid @enderror" 
                                       placeholder="Masukkan nama jenis produk..."
                                       required>
                                <div class="input-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Input Section (Optional) -->
                        <div class="form-group modern-form-group">
                            <label class="form-label modern-label">
                                <i class="fas fa-align-left mr-2"></i>
                                Deskripsi <span class="text-muted">(Opsional)</span>
                            </label>
                            <div class="input-wrapper">
                                <textarea name="deskripsi" 
                                         class="form-control modern-input @error('deskripsi') is-invalid @enderror" 
                                         placeholder="Masukkan deskripsi jenis produk..."
                                         rows="3">{{ old('deskripsi') }}</textarea>
                                <div class="input-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary modern-btn-primary">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Jenis Produk
                            </button>
                            <a href="{{ route('jenis-produk.index') }}" class="btn btn-secondary modern-btn-secondary ml-3">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Modern Card Styling */
    .modern-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
    }

    .modern-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 1.5rem 2rem;
        color: white;
    }

    .modern-header .card-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin: 0;
    }

    .modern-body {
        padding: 2.5rem;
    }

    /* Header Styling */
    .content-header-modern {
        margin-bottom: 2rem;
    }

    .header-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .header-subtitle {
        color: #718096;
        font-size: 1.1rem;
        margin: 0;
    }

    /* Photo Upload Styling */
    .photo-upload-section {
        text-align: center;
    }

    .photo-upload-container {
        max-width: 300px;
        margin: 0 auto;
    }

    .photo-preview {
        width: 200px;
        height: 200px;
        border-radius: 20px;
        border: 3px dashed #e2e8f0;
        margin: 0 auto 1rem;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .photo-preview:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 17px;
    }

    .photo-placeholder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        color: #a0aec0;
        padding: 1rem;
    }

    .photo-placeholder i {
        margin-bottom: 1rem;
        color: #cbd5e0;
    }

    .photo-placeholder p {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #4a5568;
    }

    .upload-hint {
        font-size: 0.875rem;
        color: #a0aec0;
    }

    .photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(102, 126, 234, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .photo-preview:hover .photo-overlay {
        opacity: 1;
    }

    .photo-overlay p {
        margin-top: 0.5rem;
        font-weight: 500;
    }

    /* Form Styling */
    .modern-form-group {
        margin-bottom: 2rem;
    }

    .modern-label {
        font-weight: 600;
        color: #2d3748;
        font-size: 1rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .input-wrapper {
        position: relative;
    }

    .modern-input {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 3rem 1rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .modern-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        pointer-events: none;
    }

    /* Textarea specific styling */
    textarea.modern-input {
        resize: vertical;
        min-height: 100px;
    }

    textarea.modern-input + .input-icon {
        top: 1.5rem;
        transform: none;
    }

    /* Button Styling */
    .form-actions {
        margin-top: 3rem;
        text-align: center;
    }

    .modern-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .modern-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #5a6fd8 0%, #6b42a0 100%);
        color: white;
    }

    .modern-btn-secondary {
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        color: #4a5568;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .modern-btn-secondary:hover {
        background: #edf2f7;
        border-color: #cbd5e0;
        color: #2d3748;
        transform: translateY(-1px);
        text-decoration: none;
    }

    /* Photo Action Buttons */
    .photo-actions .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .photo-actions .btn:hover {
        transform: translateY(-1px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modern-body {
            padding: 1.5rem;
        }
        
        .form-actions {
            text-align: center;
        }
        
        .modern-btn-primary,
        .modern-btn-secondary {
            width: 100%;
            margin: 0.5rem 0 !important;
        }
        
        .photo-preview {
            width: 150px;
            height: 150px;
        }
        
        .header-title {
            font-size: 1.5rem;
        }
        
        .modern-input {
            padding: 0.875rem 2.5rem 0.875rem 0.875rem;
        }
        
        .input-icon {
            right: 0.875rem;
        }
    }

    /* Animation */
    .modern-card {
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading state */
    .btn[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Error states */
    .is-invalid {
        border-color: #e53e3e !important;
    }

    .invalid-feedback {
        display: block;
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    /* Success states */
    .is-valid {
        border-color: #48bb78 !important;
    }
</style>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // Photo upload preview
    $('#fotoInput').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB = 2 * 1024 * 1024 bytes)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar!',
                    text: 'Ukuran file maksimal 2MB.',
                    confirmButtonColor: '#667eea'
                });
                $(this).val('');
                return false;
            }
            
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format File Tidak Didukung!',
                    text: 'Hanya file JPG, PNG, dan GIF yang diperbolehkan.',
                    confirmButtonColor: '#667eea'
                });
                $(this).val('');
                return false;
            }
            
            // Create preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $('#photoPreview');
                preview.html(`
                    <img src="${e.target.result}" alt="Preview" class="preview-image">
                    <div class="photo-overlay">
                        <i class="fas fa-camera fa-2x"></i>
                        <p>Klik untuk mengubah foto</p>
                    </div>
                `);
                $('#removePhoto').show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove photo
    $('#removePhoto').on('click', function(e) {
        e.stopPropagation();
        $('#fotoInput').val('');
        $('#photoPreview').html(`
            <div class="photo-placeholder">
                <i class="fas fa-image fa-3x"></i>
                <p>Klik untuk menambahkan foto</p>
                <span class="upload-hint">JPG, PNG atau GIF (Max 2MB)</span>
            </div>
        `);
        $(this).hide();
    });

    // Click photo preview to open file dialog
    $(document).on('click', '#photoPreview', function() {
        $('#fotoInput').click();
    });

    // Form validation
    $('#createForm').on('submit', function(e) {
        const nama = $('input[name="nama"]').val().trim();
        
        // Validate name length
        if (nama.length < 2) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Nama jenis produk minimal 2 karakter.',
                confirmButtonColor: '#667eea'
            });
            $('input[name="nama"]').focus();
            return false;
        }
        
        // Validate name format (no special characters except spaces and hyphens)
        const namePattern = /^[a-zA-Z0-9\s\-]+$/;
        if (!namePattern.test(nama)) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Format Nama Tidak Valid!',
                text: 'Nama hanya boleh mengandung huruf, angka, spasi, dan tanda hubung.',
                confirmButtonColor: '#667eea'
            });
            $('input[name="nama"]').focus();
            return false;
        }

        // Show loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.prop('disabled', true).html(`
            <i class="fas fa-spinner fa-spin mr-2"></i>
            Memproses...
        `);
        
        // Re-enable button after 10 seconds (fallback)
        setTimeout(function() {
            submitBtn.prop('disabled', false).html(originalText);
        }, 10000);
    });

    // Real-time validation for name input
    $('input[name="nama"]').on('input', function() {
        const value = $(this).val().trim();
        const input = $(this);
        
        if (value.length === 0) {
            input.removeClass('is-valid is-invalid');
        } else if (value.length < 2) {
            input.removeClass('is-valid').addClass('is-invalid');
        } else {
            input.removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Auto-resize textarea
    $('textarea[name="deskripsi"]').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Prevent form submission on Enter key in text inputs (except textarea)
    $('input[type="text"]').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    // Initialize tooltips if Bootstrap tooltip is available
    if (typeof $().tooltip === 'function') {
        $('[data-toggle="tooltip"]').tooltip();
    }
});

// Function to show success message (can be called from controller)
function showSuccessMessage(message) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: message,
        confirmButtonColor: '#667eea',
        timer: 3000,
        timerProgressBar: true
    });
}

// Function to show error message (can be called from controller)
function showErrorMessage(message) {
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan!',
        text: message,
        confirmButtonColor: '#667eea'
    });
}
</script>
@endsection