@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Daftar Penjualan</h1>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Dua Tombol di Atas Tabel -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah Transaksi</a> <!-- Rute diubah ke penjualan.create -->
        <a href="{{ route('revenue.index') }}" class="btn btn-success">Cek Pendapatan</a>
    </div>

    <!-- Tabel Data Transaksi -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Netto</th>
                <th>Satuan</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                    <td>{{ $data->jumlah }}</td>
                    <td>Rp {{ number_format($data->subtotal, 0, ',', '.') }}</td>
                    <td>
                        @if (is_numeric($data->netto))
                            {{ number_format($data->netto, 0, ',', '.') }}
                        @else
                            {{ $data->netto }}
                        @endif
                    </td>
                    <td>{{ $data->satuan }}</td>
                    <td>{{ $data->metode_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
