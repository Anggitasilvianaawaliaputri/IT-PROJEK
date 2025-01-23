<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Toko Yulia')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS -->
    <style>
       body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fa;
            margin: 0;
            padding: 0;
            font-size: 14px; /* Ukuran font lebih kecil */
        }

        /* Sidebar Styling */
        .sidebar {
            width: 220px; /* Lebar lebih kecil */
            height: 100vh;
            background-color: #061a11;
            position: fixed;
            top: 0;
            left: 0;
            padding: 10px 8px; /* Padding lebih kecil */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            font-size: 1.2rem; /* Ukuran font lebih kecil */
            font-weight: bold;
            color: #9fb873;
            text-align: center;
            margin-bottom: 15px; /* Margin lebih kecil */
        }

        .sidebar .menu-item {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu-item li {
            margin-bottom: 10px; /* Jarak antar item lebih kecil */
        }

        .sidebar .menu-item a {
            text-decoration: none;
            font-size: 0.9rem; /* Ukuran font lebih kecil */
            color: #ecf0f1;
            display: flex;
            align-items: center;
            gap: 8px; /* Jarak ikon dan teks lebih kecil */
            padding: 6px 8px; /* Padding lebih kecil */
            border-radius: 8px; /* Border radius lebih kecil */
            transition: all 0.3s ease;
        }

        .sidebar .menu-item a:hover {
            color: #ffffff;
            background-color: #9fb873;
        }

        .sidebar .menu-item a.active {
            color: #ffffff;
            background-color: #9fb873;
            font-weight: bold;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 220px; /* Sesuai lebar sidebar */
            padding: 10px; /* Padding lebih kecil */
            background-color: #fff;
            min-height: 100vh;
        }

        header {
            background-color: #9fb873;
            color: #fff;
            padding: 8px 12px; /* Padding lebih kecil */
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 1.2rem; /* Ukuran font lebih kecil */
            margin: 0;
        }

        header .profile img {
            width: 40px; /* Ukuran lebih kecil */
            height: 40px;
            border-radius: 50%;
        }

        footer {
            text-align: center;
            padding: 5px 0; /* Padding lebih kecil */
            font-size: 0.8rem; /* Ukuran font lebih kecil */
            color: #666;
            background-color: #f1f1f1;
            margin-top: 15px; /* Margin lebih kecil */
        }

        .profile-section {
            text-align: center;
            margin-bottom: 15px; /* Margin lebih kecil */
        }

        .profile-section img {
            width: 60px; /* Ukuran lebih kecil */
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px; /* Margin lebih kecil */
        }

        .profile-section .btn {
            background-color: #9fb873;
            color: white;
            border: none;
            padding: 8px 10px; /* Padding lebih kecil */
            border-radius: 5px;
            text-decoration: none;
        }

        .profile-section .btn:hover {
            background-color: #7a8c53;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Toko Yulia</div>

        <!-- Profile Section -->
        <div class="profile-section">
            <img src="https://png.pngtree.com/png-vector/20230320/ourlarge/pngtree-neon-shopping-cart-icon-for-supermarket-advertising-background-flyer-purchase-vector-png-image_50959812.jpg" alt="Profile" class="rounded-circle mb-2">
        </div>

        <!-- Sidebar Menu Items -->
        <ul class="menu-item">
            <li><a href="items" class="{{ Request::is('items*') ? 'active' : '' }}"><i class="bi bi-box"></i> Kelola Barang</a></li>
            <li><a href="agents" class="{{ Request::is('agents*') ? 'active' : '' }}"><i class="bi bi-people"></i> Agen</a></li>
            <li><a href="categories" class="{{ Request::is('categories*') ? 'active' : '' }}"><i class="bi bi-tag"></i> Kategori</a></li>
            <li><a href="Transaction" class="{{ Request::is('Transaction*') ? 'active' : '' }}"><i class="bi bi-basket"></i> Transaksi</a></li>
            <li><a href="penjualan" class="{{ Request::is('penjualan*') ? 'active' : '' }}"><i class="bi bi-cart-check"></i> Penjualan</a></li>
            <li><a href="report" class="{{ Request::is('report*') ? 'active' : '' }}"><i class="bi bi-file-earmark-text"></i> Laporan</a></li>
            <li><a href="accounts" class="{{ Request::is('accounts*') ? 'active' : '' }}"><i class="bi bi-person-plus"></i> Tambah Akun</a></li>
            <li><a href="tpk" class="{{ Request::is('tpk*') ? 'active' : '' }}"><i class="bi bi-basket3"></i> Produk</a></li>
        </ul>

        <!-- Logout Button -->
        <a href="/login" class="btn btn-danger d-block mt-auto">Keluar</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>@yield('title', '')</h1>
        </header>

        <main class="container mt-3">
            @yield('content')
        </main>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- Show Pop-up based on session flash messages -->
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
