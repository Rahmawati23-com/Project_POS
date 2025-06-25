<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Mainan - Sistem Kasir Modern</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Header */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }
        
        .nav-links a:hover {
            color: #667eea;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .auth-buttons {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-outline {
            color: #667eea;
            border: 2px solid #667eea;
            background: transparent;
        }
        
        .btn-outline:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }
        
        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px; /* Account for fixed header */
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="600" r="80" fill="url(%23a)"/><circle cx="700" cy="700" r="120" fill="url(%23a)"/></svg>');
            opacity: 0.3;
        }
        
        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .hero-content .highlight {
            background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }
        
        .btn-hero {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 50px;
        }
        
        .btn-white {
            background: white;
            color: #667eea;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .hero-stats {
            display: flex;
            gap: 2rem;
        }
        
        .stat {
            text-align: center;
            color: white;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            display: block;
            color: #ffeaa7;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .hero-image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .mockup {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            background: white;
            padding: 1rem;
            position: relative;
            transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
            transition: transform 0.3s ease;
        }
        
        .mockup:hover {
            transform: perspective(1000px) rotateY(-5deg) rotateX(2deg);
        }
        
        .mockup-content {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 15px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .mockup-header {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        
        .dot.red { background: #ff5f56; }
        .dot.yellow { background: #ffbd2e; }
        .dot.green { background: #27ca3f; }
        
        .mockup-dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            flex: 1;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .dashboard-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .dashboard-icon.sales { color: #00b894; }
        .dashboard-icon.products { color: #0984e3; }
        .dashboard-icon.customers { color: #e17055; }
        .dashboard-icon.reports { color: #a29bfe; }
        
        /* Features Section */
        .features {
            padding: 6rem 0;
            background: #f8f9fa;
        }
        
        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .feature-icon i {
            font-size: 1.5rem;
            color: white;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .feature-description {
            color: #666;
            line-height: 1.6;
        }
        
        /* Team Section */
        .team {
            padding: 6rem 0;
            background: white;
        }
        
        .team-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .team-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .team-card:hover::before {
            opacity: 0.05;
        }
        
        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .team-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            object-fit: cover;
            border: 4px solid #f8f9fa;
            position: relative;
            z-index: 2;
        }
        
        .team-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }
        
        .team-role {
            color: #667eea;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }
        
        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }
        
        .footer-content {
            margin-bottom: 2rem;
        }
        
        .footer-logo {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }
        
        .footer-text {
            color: #aaa;
            margin-bottom: 2rem;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: #667eea;
            transform: translateY(-2px);
        }
        
        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 1rem;
            color: #aaa;
            font-size: 0.9rem;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .auth-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .auth-buttons .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
                padding-top: 2rem;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-stats {
                justify-content: center;
                gap: 1rem;
            }
            
            .mockup {
                transform: none;
                max-width: 300px;
                margin-top: 1rem;
            }
            
            .features-grid,
            .team-grid {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 480px) {
            .nav-container {
                padding: 0 1rem;
            }
            
            .hero-container {
                padding: 0 1rem;
            }
            
            .hero-content h1 {
                font-size: 2rem;
                line-height: 1.2;
            }
            
            .hero-content p {
                font-size: 1rem;
            }
            
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .features-container,
            .team-container {
                padding: 0 1rem;
            }
        }
        
        /* Animations */
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
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .gradient-animate {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientShift 4s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">POS Mainan</div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#tim">Tim Kami</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            </div>
        </div>
    </header>
    <br></br>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content animate-fade-in-up">
                <h1>
                    Kelola Toko <span class="highlight gradient-animate">Mainan</span><br>
                    dengan Sistem POS Modern
                </h1>
                <p>
                    Tingkatkan efisiensi bisnis Anda dengan sistem kasir digital yang mudah digunakan. 
                    Kelola inventory, proses transaksi, dan pantau penjualan dalam satu platform terintegrasi.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn btn-white btn-hero">
                        <i class="fas fa-rocket"></i> Mulai Gratis
                    </a>
                    <a href="#fitur" class="btn btn-outline btn-hero" style="color: white; border-color: white;">
                        <i class="fas fa-play"></i> Lihat Demo
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Toko Aktif</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">50K+</span>
                        <span class="stat-label">Transaksi/Hari</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">99.9%</span>
                        <span class="stat-label">Uptime</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="mockup float">
                    <div class="mockup-content">
                        <div class="mockup-header">
                            <div class="dot red"></div>
                            <div class="dot yellow"></div>
                            <div class="dot green"></div>
                        </div>
                        <div class="mockup-dashboard">
                            <div class="dashboard-card">
                                <div class="dashboard-icon sales">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <strong>Sales</strong>
                            </div>
                            <div class="dashboard-card">
                                <div class="dashboard-icon products">
                                    <i class="fas fa-box"></i>
                                </div>
                                <strong>Products</strong>
                            </div>
                            <div class="dashboard-card">
                                <div class="dashboard-icon customers">
                                    <i class="fas fa-users"></i>
                                </div>
                                <strong>Customers</strong>
                            </div>
                            <div class="dashboard-card">
                                <div class="dashboard-icon reports">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <strong>Reports</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="features">
        <div class="features-container">
            <div class="section-header">
                <h2 class="section-title">Fitur Unggulan</h2>
                <p class="section-subtitle">
                    Dilengkapi dengan berbagai fitur canggih untuk memudahkan pengelolaan toko mainan Anda
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <h3 class="feature-title">Kasir Digital</h3>
                    <p class="feature-description">
                        Proses transaksi dengan cepat dan akurat. Mendukung berbagai metode pembayaran dan cetak struk otomatis.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h3 class="feature-title">Manajemen Stok</h3>
                    <p class="feature-description">
                        Pantau stok barang real-time, notifikasi stok menipis, dan kelola supplier dengan mudah.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="feature-title">Laporan Penjualan</h3>
                    <p class="feature-description">
                        Analisis penjualan mendalam dengan grafik interaktif dan export data dalam berbagai format.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Manajemen Karyawan</h3>
                    <p class="feature-description">
                        Atur akses karyawan, track performa, dan kelola shift kerja dengan sistem yang terintegrasi.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Multi Platform</h3>
                    <p class="feature-description">
                        Akses dari mana saja melalui web, desktop, atau mobile. Data tersinkronisasi secara real-time.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Keamanan Data</h3>
                    <p class="feature-description">
                        Enkripsi tingkat enterprise, backup otomatis, dan perlindungan data pelanggan yang terjamin.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="tim" class="team">
        <div class="team-container">
            <div class="section-header">
                <h2 class="section-title">Tim Pengembang</h2>
                <p class="section-subtitle">
                    Dibangun oleh tim profesional berpengalaman dalam teknologi dan retail
                </p>
            </div>
            <div class="team-grid">
                <div class="team-card">
                    <img src="{{ asset('storage/rahma.jpg') }}" alt="Rahma" class="team-avatar">
                    <h3 class="team-name">Rahmawati Ibrahim</h3>
                    <p class="team-role">Team Pengembang 1</p>
                </div>
                <div class="team-card">
                    <img src="{{ asset('storage/clarissa.jpg') }}" alt="Agung" class="team-avatar">
                    <h3 class="team-name">Clarissa Issabella</h3>
                    <p class="team-role">Team Pengembang 2</p>
                </div>
                <div class="team-card">
                    <img src="https://i.pinimg.com/736x/8e/d2/9c/8ed29c5c9a5c8f5b1b3f5e8d2f3e4c7a.jpg" alt="Dina" class="team-avatar">
                    <h3 class="team-name">Dina</h3>
                    <p class="team-role">UI/UX Designer</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">POS Mainan</div>
                <p class="footer-text">
                    Solusi terpercaya untuk sistem kasir modern yang membantu mengembangkan bisnis retail Anda.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 POS Mainan. Semua hak dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header background change on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = 'none';
            }
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all feature cards and team cards
        document.querySelectorAll('.feature-card, .team-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Add hover effects to buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Counter animation for stats
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toString().includes('K') ? target : target + (target.toString().includes('.') ? '%' : '+');
                    clearInterval(timer);
                } else {
                    if (target.toString().includes('K')) {
                        element.textContent = Math.floor(current) + 'K+';
                    } else if (target.toString().includes('.')) {
                        element.textContent = current.toFixed(1) + '%';
                    } else {
                        element.textContent = Math.floor(current) + '+';
                    }
                }
            }, 20);
        }

        // Trigger counter animation when hero section is visible
        const heroObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statNumbers = document.querySelectorAll('.stat-number');
                    setTimeout(() => {
                        animateCounter(statNumbers[0], 1000);
                    }, 500);
                    setTimeout(() => {
                        animateCounter(statNumbers[1], 50);
                    }, 700);
                    setTimeout(() => {
                        animateCounter(statNumbers[2], 99.9);
                    }, 900);
                    heroObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const heroSection = document.querySelector('.hero');
        if (heroSection) {
            heroObserver.observe(heroSection);
        }

        // Mobile menu toggle (if needed)
        const navToggle = document.createElement('button');
        navToggle.innerHTML = '<i class="fas fa-bars"></i>';
        navToggle.className = 'nav-toggle';
        navToggle.style.display = 'none';
        navToggle.style.background = 'none';
        navToggle.style.border = 'none';
        navToggle.style.fontSize = '1.5rem';
        navToggle.style.color = '#333';
        navToggle.style.cursor = 'pointer';

        // Add mobile menu functionality
        function checkMobile() {
            if (window.innerWidth <= 768) {
                navToggle.style.display = 'block';
                document.querySelector('.nav-links').style.display = 'none';
            } else {
                navToggle.style.display = 'none';
                document.querySelector('.nav-links').style.display = 'flex';
            }
        }

        // Insert toggle button
        document.querySelector('.nav-container').insertBefore(navToggle, document.querySelector('.auth-buttons'));

        // Check on load and resize
        checkMobile();
        window.addEventListener('resize', checkMobile);

        // Toggle mobile menu
        navToggle.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            if (navLinks.style.display === 'none' || navLinks.style.display === '') {
                navLinks.style.display = 'flex';
                navLinks.style.flexDirection = 'column';
                navLinks.style.position = 'absolute';
                navLinks.style.top = '100%';
                navLinks.style.left = '0';
                navLinks.style.width = '100%';
                navLinks.style.background = 'white';
                navLinks.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
                navLinks.style.padding = '1rem';
                navLinks.style.zIndex = '1000';
            } else {
                navLinks.style.display = 'none';
            }
        });

        // Parallax effect for hero background
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.backgroundPosition = `center ${rate}px`;
            }
        });

        // Loading animation
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>