@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Penjualan</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah Terjual</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salesSummary as $sale)
            <tr>
                <td>{{ $sale['nama_produk'] }}</td>
                <td>{{ $sale['harga'] }}</td>
                <td>{{ $sale['jumlah_terjual'] }}</td>
                <td>{{ $sale['total_penjualan'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
