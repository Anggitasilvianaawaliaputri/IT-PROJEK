@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Ranking Produk</h1>

    <!-- Tabel Ranking Produk -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $product)
                <tr>
                    <td>{{ $product->ranking }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>Rp {{ number_format($product->original_harga, 0, ',', '.') }}</td>
                    <td>{{ $product->original_jumlah }}</td>
                    <td>{{ number_format($product->score, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection