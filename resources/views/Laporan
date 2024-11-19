<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Karyawan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e9ecef;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 20px 20px;
            margin-bottom: 30px;
        }
        .container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            padding: 12px 20px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table td {
            background-color: #f8f9fa;
        }
        .modal-content {
            border-radius: 20px;
        }
        .modal-header {
            border-bottom: none;
        }
        .modal-title {
            color: #007bff;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
        /* Menghilangkan spinner di Chrome, Safari, Edge */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Menghilangkan spinner di Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
        /* Tambahan untuk memperbaiki posisi tombol */
        .btn-tambah {
            margin-bottom: 20px; /* Menambah jarak tombol dari elemen lainnya */
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Data Laporan Karyawan</h1>
</div>

<div class="container">
    <!-- Tombol untuk membuka modal input laporan di bagian atas tabel -->
    <button type="button" class="btn btn-primary btn-tambah" data-bs-toggle="modal" data-bs-target="#modalLaporan">
        <i class="fas fa-plus-circle"></i> Tambah Laporan
    </button>

    <!-- Modal untuk input laporan baru -->
    <div class="modal fade" id="modalLaporan" tabindex="-1" aria-labelledby="modalLaporanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLaporanLabel">Form Laporan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan:</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="mb-3">
                            <label for="pendapatan" class="form-label">Pendapatan:</label>
                            <input type="number" class="form-control" id="pendapatan" name="pendapatan" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Laporan -->
    <div class="table-container">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Pendapatan</th>
                    <th>Aksi</th> <!-- Kolom untuk Edit dan Hapus -->
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $laporan)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $laporan->nama_karyawan }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d F Y') }}</td>
                    <td>Rp {{ number_format($laporan->pendapatan, 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('post.edit', $laporan->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('post.destroy', $laporan->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
