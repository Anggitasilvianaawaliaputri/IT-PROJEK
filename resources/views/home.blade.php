<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kelontong Ibu Yulia</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .produk .card img {
            height: 200px;
            object-fit: cover;
        }

        footer {
            background-color: #dc3545;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .card-body h6 {
            font-size: 14px;
            margin: 10px 0;
        }

        .card-body .text-danger {
            font-size: 16px;
            font-weight: bold;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Toko Kelontong Ibu Yulia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Produk</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Promo</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Produk Rekomendasi -->
    <section class="produk mt-4">
        <div class="container">
            <h3 class="text-center mb-4">Produk Rekomendasi</h3>
            <div class="row">
                <!-- Produk 1 -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 1">
                        <div class="card-body text-center">
                            <h6 class="card-title">Happy Tos Keripik Tortilla Merah 140 g</h6>
                            <p class="text-danger">Rp 11.300</p>
                            <button class="btn btn-danger w-100">Beli</button>
                        </div>
                    </div>
                </div>
                <!-- Produk 2 -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 2">
                        <div class="card-body text-center">
                            <h6 class="card-title">Ekonomi Sabun Cuci Piring 65 g</h6>
                            <p class="text-danger">Rp 6.900</p>
                            <button class="btn btn-danger w-100">Beli</button>
                        </div>
                    </div>
                </div>
                <!-- Produk 3 -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 3">
                        <div class="card-body text-center">
                            <h6 class="card-title">Sedaap Mi Instan Goreng 5 x 90 g</h6>
                            <p class="text-danger">Rp 15.400</p>
                            <button class="btn btn-danger w-100">Beli</button>
                        </div>
                    </div>
                </div>
                <!-- Produk 4 -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 4">
                        <div class="card-body text-center">
                            <h6 class="card-title">Sari Roti Tawar Jumbo 555 g</h6>
                            <p class="text-danger">Rp 18.000</p>
                            <button class="btn btn-danger w-100">Beli</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Selengkapnya -->
            <div class="text-center mt-3">
                <a href="#" class="btn btn-outline-danger">Lihat Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p class="mb-0">Toko Kelontong Ibu Yulia &copy; 2024. Semua Hak Dilindungi.</p>
    </footer>

    <!-- Link Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
