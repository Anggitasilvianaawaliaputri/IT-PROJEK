@extends('layouts.app') <!-- Menggunakan layout umum -->

@section('content') <!-- Bagian konten halaman -->
<div class="container mt-5">
    <div class="header mb-4 text-center">
        <h1>Transaksi Pembelian</h1> <!-- Judul halaman -->
    </div>

    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk menambah transaksi -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTransaksi">
        <i class="fas fa-plus-circle"></i> Tambah Transaksi
    </button>

    <!-- Modal tambah transaksi -->
    <div class="modal fade" id="modalTransaksi" tabindex="-1" aria-labelledby="modalTransaksiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTransaksiLabel">Form Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambah transaksi -->
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Agen:</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="item_name" class="form-label">Nama Barang:</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga:</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel data transaksi -->
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Agen</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($transactions as $key => $transaction)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $transaction->customer_name }}</td>
                <td>{{ $transaction->item_name }}</td>
                <td>{{ $transaction->quantity }}</td>
                <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <!-- Form Hapus -->
                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection