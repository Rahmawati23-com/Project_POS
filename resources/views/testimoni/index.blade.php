@extends('adminlte::page')

@section('title', 'Testimoni Pelanggan')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Testimoni Pelanggan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active text-dark">Testimoni</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="testimoni-wrapper">
    <div class="container-fluid">
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- Header Section -->
        <div class="testimonial-header">
            <div class="header-icon">
                <i class="fas fa-quote-left"></i>
            </div>
            <h1>Testimoni Pelanggan</h1>
            <p>Lihat apa yang dikatakan pelanggan kami tentang layanan dan produk berkualitas tinggi yang kami berikan</p>
        </div>

        <!-- Action Buttons - Manager Only -->
        @can('manage-testimoni')
        <div class="manager-actions mb-4">
            <a href="{{ route('testimoni.create') }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Testimoni Baru
            </a>
        </div>
        @endcan

        <!-- Testimonials Grid -->
        <div class="testimonials-grid">
            @forelse($testimonials ?? [] as $testimonial)
            <div class="testimonial-card" data-aos="fade-up">
                <div class="card-header">
                    <div class="quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= ($testimonial->rating ?? 5) ? 'filled' : '' }}"></i>
                            @endfor
                        </div>
                        <span class="rating-text">{{ $testimonial->rating ?? 5 }}.0</span>
                    </div>
                </div>

                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "{{ $testimonial->komentar ?? 'Great service!' }}"
                    </p>
                </div>

                <div class="profile-section">
                    <div class="profile-image-wrapper">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->nama_tokoh ?? 'User') }}&background=2563eb&color=fff&size=80" 
                             alt="{{ $testimonial->nama_tokoh ?? 'User' }}" 
                             class="profile-image">
                    </div>
                    <div class="profile-info">
                        <h4>{{ $testimonial->nama_tokoh ?? 'Anonymous' }}</h4>
                        <p class="role">Pelanggan</p>
                        <p class="date">{{ $testimonial->created_at ? $testimonial->created_at->format('d M Y') : 'Recent' }}</p>
                    </div>
                </div>

                <!-- Action buttons untuk manager -->
                @can('manage-testimoni')
                <div class="card-actions">
                    <a href="{{ route('testimoni.edit', $testimonial->id) }}" class="btn-action btn-edit" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('testimoni.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Delete" 
                                onclick="return confirm('Yakin ingin menghapus testimoni ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endcan
            </div>
            @empty
            <!-- Default Testimonials -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="0">
                <div class="card-header">
                    <div class="quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                        </div>
                        <span class="rating-text">5.0</span>
                    </div>
                </div>

                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Layanan yang luar biasa! Tim mereka sangat profesional dan responsif. Proyek kami selesai tepat waktu dengan kualitas yang melebihi ekspektasi. Sangat merekomendasikan untuk semua kebutuhan bisnis Anda."
                    </p>
                </div>

                <div class="profile-section">
                    <div class="profile-image-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=2563eb&color=fff&size=80" 
                             alt="Sarah Johnson" class="profile-image">
                    </div>
                    <div class="profile-info">
                        <h4>Sarah Johnson</h4>
                        <p class="role">Pelanggan</p>
                        <p class="date">15 Jan 2025</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header">
                    <div class="quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                        </div>
                        <span class="rating-text">5.0</span>
                    </div>
                </div>

                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Kerjasama yang sangat memuaskan! Mereka memahami visi bisnis kami dan memberikan solusi yang tepat. ROI yang kami dapatkan jauh melebihi investasi awal. Partnership yang akan kami lanjutkan!"
                    </p>
                </div>

                <div class="profile-section">
                    <div class="profile-image-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Michael+Chen&background=2563eb&color=fff&size=80" 
                             alt="Michael Chen" class="profile-image">
                    </div>
                    <div class="profile-info">
                        <h4>Michael Chen</h4>
                        <p class="role">Pelanggan</p>
                        <p class="date">12 Jan 2025</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header">
                    <div class="quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                        </div>
                        <span class="rating-text">5.0</span>
                    </div>
                </div>

                <div class="testimonial-content">
                    <p class="testimonial-text">
                        "Tim yang sangat kompeten dan kreatif! Mereka tidak hanya mengerjakan sesuai brief, tapi juga memberikan input valuable yang membuat hasil akhir menjadi lebih optimal. Highly recommended!"
                    </p>
                </div>

                <div class="profile-section">
                    <div class="profile-image-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Jessica+Rodriguez&background=2563eb&color=fff&size=80" 
                             alt="Jessica Rodriguez" class="profile-image">
                    </div>
                    <div class="profile-info">
                        <h4>Jessica Rodriguez</h4>
                        <p class="role">Pelanggan</p>
                        <p class="date">08 Jan 2025</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Customer Action Button -->
        @cannot('manage-testimoni')
        <div class="customer-actions">
            <button class="btn btn-primary btn-lg btn-give-rating" onclick="showTestimonialForm()">
                <i class="fas fa-star mr-2"></i>Berikan Rating & Testimoni
            </button>
        </div>
        @endcannot
    </div>
</div>

<!-- Modal untuk form testimoni customer -->
<div class="modal fade" id="testimonialModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-star mr-2"></i>Berikan Rating & Testimoni Anda
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('testimoni.store') }}" method="POST" id="testimonialForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_tokoh">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" class="form-control @error('nama_tokoh') is-invalid @enderror" 
                                       id="nama_tokoh" name="nama_tokoh" value="{{ old('nama_tokoh') }}" required>
                                @error('nama_tokoh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rating">Rating <span class="required">*</span></label>
                                <select class="form-control @error('rating') is-invalid @enderror" 
                                        id="rating" name="rating" required>
                                    <option value="">Pilih Rating</option>
                                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>★★★★★ (5 - Sangat Puas)</option>
                                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>★★★★☆ (4 - Puas)</option>
                                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>★★★☆☆ (3 - Cukup)</option>
                                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>★★☆☆☆ (2 - Kurang)</option>
                                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>★☆☆☆☆ (1 - Tidak Puas)</option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="komentar">Testimoni <span class="required">*</span></label>
                        <textarea class="form-control @error('komentar') is-invalid @enderror" 
                                  id="komentar" name="komentar" rows="4" 
                                  placeholder="Ceritakan pengalaman Anda dengan layanan kami..." required>{{ old('komentar') }}</textarea>
                        @error('komentar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hidden fields untuk relasi -->
                    <input type="hidden" name="produk_id" value="1">
                    <input type="hidden" name="kategori_tokoh_id" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Testimoni
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
:root {
    --primary-blue: #2563eb;
    --secondary-blue: #3b82f6;
    --light-blue: #dbeafe;
    --dark-blue: #1e40af;
    --accent-blue: #60a5fa;
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --white: #ffffff;
    --light-gray: #f8fafc;
    --border-gray: #e5e7eb;
}

/* Main Wrapper - White Background */
.testimoni-wrapper {
    background: var(--white);
    min-height: calc(100vh - 57px);
    padding: 30px 0 50px 0;
}

/* Header Section */
.testimonial-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 20px;
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--dark-blue) 100%);
    border-radius: 20px;
    color: white;
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
}

.header-icon {
    margin-bottom: 20px;
}

.header-icon i {
    font-size: 3rem;
    color: rgba(255, 255, 255, 0.9);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 0.9; }
    50% { transform: scale(1.05); opacity: 1; }
    100% { transform: scale(1); opacity: 0.9; }
}

.testimonial-header h1 {
    color: #ffffff !important;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
}

.testimonial-header p {
    color: rgba(255, 255, 255, 0.95) !important;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
}

/* Manager Actions */
.manager-actions {
    text-align: center;
    margin-bottom: 30px;
}

.manager-actions .btn {
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

.manager-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

/* Testimonials Grid */
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

/* Blue Cards */
.testimonial-card {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    color: white;
}

.testimonial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ffffff, rgba(255, 255, 255, 0.7), #ffffff);
}

.testimonial-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(37, 99, 235, 0.3);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.quote-icon {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Rating */
.rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stars {
    display: flex;
    gap: 3px;
}

.stars .fas {
    color: rgba(255, 255, 255, 0.3);
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.stars .fas.filled {
    color: #fbbf24;
    text-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
}

.rating-text {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
    font-weight: 600;
}

.testimonial-content {
    margin-bottom: 25px;
}

.testimonial-text {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.05rem;
    line-height: 1.6;
    font-style: italic;
    margin: 0;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
}

.profile-section {
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile-image-wrapper {
    position: relative;
}

.profile-image {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.testimonial-card:hover .profile-image {
    transform: scale(1.05);
    border-color: rgba(255, 255, 255, 0.6);
}

.profile-info h4 {
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 3px;
}

.profile-info .role {
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    font-size: 0.9rem;
    margin-bottom: 2px;
}

.profile-info .date {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.8rem;
    margin: 0;
}

/* Card Actions for Manager */
.card-actions {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.testimonial-card:hover .card-actions {
    opacity: 1;
}

.btn-action {
    width: 35px;
    height: 35px;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.85rem;
    backdrop-filter: blur(10px);
}

.btn-edit {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-edit:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.8);
    color: #ffffff;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 1);
    transform: scale(1.1);
}

/* Customer Actions */
.customer-actions {
    text-align: center;
    padding: 30px 0;
}

.btn-give-rating {
    padding: 15px 40px;
    font-size: 1.2rem;
    font-weight: 600;
    border-radius: 50px;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
    background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
    border: none;
}

.btn-give-rating:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(37, 99, 235, 0.4);
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.modal-header {
    border-radius: 15px 15px 0 0;
    border-bottom: none;
    padding: 20px 30px;
}

.modal-title {
    font-weight: 600;
    font-size: 1.2rem;
}

.modal-body {
    padding: 30px;
}

.modal-footer {
    padding: 20px 30px;
    border-top: 1px solid var(--border-gray);
}

/* Form Styles */
.form-group label {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 8px;
}

.required {
    color: #ef4444;
}

.form-control {
    border: 2px solid var(--border-gray);
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
}

.is-invalid {
    border-color: #ef4444;
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 5px;
}

/* Alert Styles */
.alert {
    margin-bottom: 25px;
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.alert-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.alert-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.alert .close {
    color: white;
    opacity: 0.8;
}

.alert .close:hover {
    opacity: 1;
}

/* Content Header */
.content-header {
    background: transparent;
    margin-bottom: 20px;
}

.content-header h1 {
    color: var(--text-dark) !important;
    font-weight: 700;
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: var(--primary-blue);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--text-dark);
}

/* Responsive Design */
@media (max-width: 768px) {
    .testimonial-header {
        padding: 30px 15px;
        margin-bottom: 30px;
    }
    
    .testimonial-header h1 {
        font-size: 2rem;
    }
    
    .testimonial-header p {
        font-size: 1rem;
    }
    
    .testimonials-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .testimonial-card {
        padding: 25px;
    }
    
    .manager-actions .btn,
    .btn-give-rating {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }
    
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .quote-icon {
        align-self: center;
    }
}

@media (max-width: 480px) {
    .testimoni-wrapper {
        padding: 20px 0 30px 0;
    }
    
    .testimonial-header {
        margin-bottom: 25px;
        padding: 25px 15px;
    }
    
    .testimonial-header h1 {
        font-size: 1.8rem;
    }
    
    .testimonials-grid {
        margin-bottom: 30px;
    }
    
    .testimonial-card {
        padding: 20px;
        margin: 0 10px;
    }
    
    .modal-dialog {
        margin: 10px;
    }
    
    .modal-body,
    .modal-footer {
        padding: 20px;
    }
}

/* Animation Classes */
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

.testimonial-card {
    animation: fadeInUp 0.6s ease forwards;
}

.testimonial-card:nth-child(1) { animation-delay: 0.1s; }
.testimonial-card:nth-child(2) { animation-delay: 0.2s; }
.testimonial-card:nth-child(3) { animation-delay: 0.3s; }
.testimonial-card:nth-child(4) { animation-delay: 0.4s; }
.testimonial-card:nth-child(5) { animation-delay: 0.5s; }
.testimonial-card:nth-child(6) { animation-delay: 0.6s; }

/* Focus States for Accessibility */
.btn:focus,
.btn-action:focus {
    outline: 2px solid var(--accent-blue);
    outline-offset: 2px;
}


@media (prefers-contrast: high) {
    .testimonial-card {
        border: 2px solid #ffffff;
    }
    
    .testimonial-text,
    .profile-info h4,
    .profile-info .role,
    .profile-info .date {
        text-shadow: none;
        font-weight: 600;
    }
    
    .btn-action {
        border: 2px solid #ffffff;
    }
}

@media (prefers-reduced-motion: reduce) {
    .testimonial-card,
    .btn,
    .btn-action,
    .profile-image,
    .card-actions {
        transition: none;
        animation: none;
    }
    
    .header-icon i {
        animation: none;
    }
    
    .testimonial-card:hover {
        transform: none;
    }
    
    .btn:hover,
    .btn-action:hover {
        transform: none;
    }
}

/* Print Styles */
@media print {
    .testimoni-wrapper {
        background: white !important;
        box-shadow: none !important;
    }
    
    .testimonial-card {
        background: white !important;
        color: black !important;
        border: 1px solid #000 !important;
        box-shadow: none !important;
        page-break-inside: avoid;
        margin-bottom: 20px;
    }
    
    .testimonial-header {
        background: white !important;
        color: black !important;
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
    
    .testimonial-header h1,
    .testimonial-header p {
        color: black !important;
        text-shadow: none !important;
    }
    
    .testimonial-text,
    .profile-info h4,
    .profile-info .role,
    .profile-info .date {
        color: black !important;
        text-shadow: none !important;
    }
    
    .manager-actions,
    .customer-actions,
    .card-actions {
        display: none !important;
    }
    
    .stars .fas.filled {
        color: black !important;
        text-shadow: none !important;
    }
    
    .quote-icon {
        background: #f0f0f0 !important;
        color: black !important;
        border: 1px solid #000 !important;
    }
}


.testimonial-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    color: var(--text-light);
}

.testimonial-loading i {
    font-size: 2rem;
    margin-right: 15px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Error State */
.testimonial-error {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-light);
}

.testimonial-error i {
    font-size: 3rem;
    color: #ef4444;
    margin-bottom: 20px;
}

.testimonial-error h3 {
    color: var(--text-dark);
    margin-bottom: 10px;
}

.testimonial-error p {
    color: var(--text-light);
    margin-bottom: 20px;
}

/* Empty State */
.testimonial-empty {
    text-align: center;
    padding: 80px 20px;
    color: var(--text-light);
}

.testimonial-empty i {
    font-size: 4rem;
    color: var(--accent-blue);
    margin-bottom: 25px;
    opacity: 0.6;
}

.testimonial-empty h3 {
    color: var(--text-dark);
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.testimonial-empty p {
    color: var(--text-light);
    margin-bottom: 30px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

@media (max-width: 768px) {
    .customer-actions {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        padding: 0;
    }
    
    .btn-give-rating {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        padding: 0;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-give-rating span {
        display: none;
    }
    
    .btn-give-rating i {
        margin: 0;
    }
}

/* Tooltip Styles */
.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 8px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    font-size: 0.8rem;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: rgba(0, 0, 0, 0.8) transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}

/* Scrollbar Styling */
.testimonials-grid::-webkit-scrollbar {
    width: 8px;
}

.testimonials-grid::-webkit-scrollbar-track {
    background: var(--light-gray);
    border-radius: 10px;
}

.testimonials-grid::-webkit-scrollbar-thumb {
    background: var(--accent-blue);
    border-radius: 10px;
}

.testimonials-grid::-webkit-scrollbar-thumb:hover {
    background: var(--primary-blue);
}

/* Performance Optimizations */
.testimonial-card {
    will-change: transform;
    backface-visibility: hidden;
    transform: translateZ(0);
}

.profile-image {
    will-change: transform;
    backface-visibility: hidden;
}

/* Accessibility Improvements */
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

/* Focus indicators */
.testimonial-card:focus-within {
    outline: 2px solid var(--accent-blue);
    outline-offset: 4px;
}

/* Interactive Elements */
.testimonial-card {
    cursor: default;
}

.testimonial-card:hover .testimonial-text {
    transform: translateY(-1px);
}

.testimonial-card:hover .stars .fas.filled {
    animation: twinkle 0.6s ease-in-out;
}

@keyframes twinkle {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Modal Animation */
.modal.fade .modal-dialog {
    transform: translate(0, -50px);
    transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog {
    transform: translate(0, 0);
}

/* Button Ripple Effect */
.btn-ripple {
    position: relative;
    overflow: hidden;
}

.btn-ripple::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-ripple:active::before {
    width: 300px;
    height: 300px;
}
</style>

<script>
// JavaScript untuk modal dan interaksi
function showTestimonialForm() {
    $('#testimonialModal').modal('show');
}

// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});

// Form validation
document.getElementById('testimonialForm').addEventListener('submit', function(e) {
    const nama = document.getElementById('nama_tokoh').value.trim();
    const rating = document.getElementById('rating').value;
    const komentar = document.getElementById('komentar').value.trim();
    
    if (!nama || !rating || !komentar) {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi.');
        return false;
    }
    
    if (komentar.length < 10) {
        e.preventDefault();
        alert('Testimoni minimal harus 10 karakter.');
        return false;
    }
});

// Rating hover effect
document.getElementById('rating').addEventListener('change', function() {
    const value = this.value;
    const stars = this.parentElement.querySelectorAll('.rating-preview .fa-star');
    
    stars.forEach((star, index) => {
        if (index < value) {
            star.classList.add('filled');
        } else {
            star.classList.remove('filled');
        }
    });
});

// Smooth scroll untuk mobile
if (window.innerWidth <= 768) {
    document.querySelectorAll('.testimonial-card').forEach(card => {
        card.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        card.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

// Lazy loading untuk avatar images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.profile-image');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
});

// Handle delete confirmation with better UX
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        const testimonialCard = this.closest('.testimonial-card');
        const customerName = testimonialCard.querySelector('.profile-info h4').textContent;
        
        if (confirm(`Yakin ingin menghapus testimoni dari ${customerName}?`)) {
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;
            
            // Submit form
            this.closest('form').submit();
        }
    });
});

// Enhanced modal interactions
$('#testimonialModal').on('show.bs.modal', function() {
    document.body.style.overflow = 'hidden';
});

$('#testimonialModal').on('hidden.bs.modal', function() {
    document.body.style.overflow = 'auto';
    // Reset form
    document.getElementById('testimonialForm').reset();
});

// Character counter for textarea
document.getElementById('komentar').addEventListener('input', function() {
    const maxLength = 500;
    const currentLength = this.value.length;
    
    let counter = this.parentElement.querySelector('.char-counter');
    if (!counter) {
        counter = document.createElement('small');
        counter.className = 'char-counter text-muted';
        this.parentElement.appendChild(counter);
    }
    
    counter.textContent = `${currentLength}/${maxLength} karakter`;
    
    if (currentLength > maxLength) {
        counter.classList.add('text-danger');
        counter.classList.remove('text-muted');
    } else {
        counter.classList.add('text-muted');
        counter.classList.remove('text-danger');
    }
});

// Add ripple effect to buttons
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.classList.add('btn-ripple');
    });
});

// Keyboard navigation for testimonial cards
document.addEventListener('keydown', function(e) {
    if (e.target.classList.contains('testimonial-card')) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            // Focus on first interactive element in card
            const firstButton = e.target.querySelector('.btn-action');
            if (firstButton) {
                firstButton.focus();
            }
        }
    }
});

// Progressive enhancement for better performance
if ('IntersectionObserver' in window) {
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });
    
    document.querySelectorAll('.testimonial-card').forEach(card => {
        cardObserver.observe(card);
    });
}

// Error handling for network requests
window.addEventListener('online', function() {
    document.querySelectorAll('.network-error').forEach(error => {
        error.style.display = 'none';
    });
});

window.addEventListener('offline', function() {
    const errorMessage = document.createElement('div');
    errorMessage.className = 'alert alert-warning network-error';
    errorMessage.innerHTML = '<i class="fas fa-wifi mr-2"></i>Tidak ada koneksi internet. Beberapa fitur mungkin tidak tersedia.';
    
    document.querySelector('.testimoni-wrapper .container-fluid').insertBefore(
        errorMessage, 
        document.querySelector('.testimonial-header')
    );
});
</script>

@stop