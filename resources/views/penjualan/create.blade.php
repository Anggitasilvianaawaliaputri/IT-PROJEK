@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Tambah Penjualan</h1>
    <form action="{{ route('penjualan.store') }}" method="POST"> <!-- Rute diubah ke penjualan.store -->
        @csrf
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan nama barang..." required>
        </div>
        
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="netto">Netto</label>
            <input type="number" name="netto" class="form-control" step="0.01" value="{{ old('netto', $item->netto ?? '') }}" required>
        </div>

        <!-- Penambahan satuan -->
        <div class="form-group">
            <label for="satuan">Satuan</label>
            <select name="satuan" id="satuan" class="form-select" required>
                <option value="Kg">Kg</option>
                <option value="Gram">Gram</option>
                <option value="Liter">Liter</option>
                <option value="Pcs">Pcs</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-select" required>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a> <!-- Rute diubah ke penjualan.index -->
    </form>
</div>
@endsection
