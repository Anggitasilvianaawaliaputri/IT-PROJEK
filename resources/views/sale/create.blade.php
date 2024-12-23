@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Tambah Transaksi</h1>
    <form action="{{ route('sale.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Karyawan</label>
            <input type="text" name="nama_karyawan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
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
        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-select" required>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection