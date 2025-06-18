<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang - Sistem POS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: #fff;
            background: url('https://i.pinimg.com/736x/1e/d2/e4/1ed2e4ec56297baa379f167c34622471.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Overlay transparan di atas background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Ubah opacity di sini */
            z-index: 1;
        }

        .overlay {
            position: relative;
            z-index: 2;
            background-color: rgba(0, 0, 0, 0.4);
            padding: 60px 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 40px;
            max-width: 90%;
            backdrop-filter: blur(2px); /* Tambahan blur lembut */
        }

        .text-area {
            max-width: 500px;
        }

        .text-area h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .text-area p {
            font-size: 18px;
            color: #dcdde1;
        }

        .text-area a {
            display: inline-block;
            margin-top: 30px;
            background-color: #00a8ff;
            color: #fff;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .text-area a:hover {
            background-color: #0097e6;
        }

        .image-area img {
            max-width: 300px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        @media (max-width: 768px) {
            .overlay {
                flex-direction: column;
                text-align: center;
                padding: 40px 20px;
            }

            .image-area img {
                max-width: 220px;
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="text-area">
            <h1>Selamat Datang di Sistem POS</h1>
            <p>Kelola penjualan Toko Mainan dan lainnya dengan efisien dan profesional.</p>
            <a href="{{ route('login') }}">Masuk Dashboard</a>
        </div>
        <div class="image-area">
            <img src="https://i.pinimg.com/736x/a4/34/87/a43487c4f63b11044403ed2149c70cba.jpg" alt="Contoh Produk POS">
        </div>
    </div>
</body>
</html>
