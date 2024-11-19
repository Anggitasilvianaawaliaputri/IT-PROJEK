<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', '')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fa;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }

        /* Header styling */
        header {
            background-color: #2980b9;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-weight: 600;
            font-size: 2.3rem;
            letter-spacing: 1px;
            margin: 0;
        }

        /* Navbar Styling */
        nav.navbar {
            border-bottom: 3px solid #2980b9; /* Garis bawah biru */
            padding: 10px 0;
        }

        nav .navbar-brand {
            color: #2980b9; /* Warna teks brand */
            font-weight: bold;
            font-size: 1.5rem;
        }

        nav .navbar-nav {
            flex-direction: row; /* Meratakan item navbar dalam satu baris */
        }

        nav .navbar-nav .nav-link {
            color: #2980b9; /* Warna teks nav link */
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 15px; /* Padding yang lebih konsisten */
            transition: all 0.3s ease;
            border-radius: 5px; /* Tambahkan border radius untuk sudut yang lebih halus */
            margin: 0; /* Hapus margin untuk meratakan */
        }

        nav .navbar-nav .nav-link:hover {
            color: #fff; /* Warna teks saat hover */
            background-color: #2980b9; /* Warna latar belakang saat hover */
            text-shadow: none; /* Hapus text shadow saat hover */
        }

        /* Main content styling */
        main {
            padding: 50px 20px;
            margin-top: 30px;
        }

        main h2 {
            font-size: 2rem;
            color: #34495e;
            font-weight: 600;
            margin-bottom: 25px;
        }

        /* Footer styling */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9rem;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        /* Button Styling */
        .btn-custom {
            background-color: #3498db;
            color: #fff;
            font-weight: 500;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #2980b9;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }

            nav .navbar-nav .nav-link {
                font-size: 0.9rem;
                padding: 8px 12px; /* Sesuaikan padding untuk tampilan kecil */
            }
        }

    </style>
</head>
<body>
    <header>
        <h1>@yield('title','Toko Yulia')</h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="items">Cek Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agents">Agen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Transaction">Transaksi Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Laporan">Laporan Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accounts">Tambah Akun</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 My Application. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
