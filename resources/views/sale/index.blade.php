@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-success">Transaksi Penjualan</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-end mb-4">
        <a href="{{ route('sale.create') }}" class="btn btn-primary btn-lg shadow"> Tambah Transaksi</a>
        <form action="{{ route('sale.pendapatan') }}" method="GET" class="d-flex align-items-center gap-3">
            <div>
                <label for="tanggal_awal" class="form-label fw-bold">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control border-success" required>
            </div>
            <div>
                <label for="tanggal_akhir" class="form-label fw-bold">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control border-success" required>
            </div>
            <button type="submit" class="btn btn-success btn-lg shadow mt-auto">Lihat Pendapatan</button>
        </form>
    </div>

    <table class="table table-bordered table-striped text-center shadow-sm">
        <thead class="bg-success text-white">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Metode Pembayaran</th>
        </thead>
        <tbody>
            @foreach ($penjualan as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama_karyawan }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                    <td>{{ $data->jumlah }}</td>
                    <td>Rp {{ number_format($data->subtotal, 0, ',', '.') }}</td>
                    <td>{{ $data->metode_pembayaran }}</td>
                    <td>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
