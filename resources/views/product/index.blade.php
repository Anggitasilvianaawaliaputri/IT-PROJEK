@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Daftar Produk</h1>

    <!-- Tabel Data Produk -->
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Netto</th> <!-- Kolom Netto -->
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->jumlah }}</td>
                    <td>{{ number_format($product->netto, 0, ',', '.') }}</td> <!-- Tampilkan Netto -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Button untuk Lihat Ranking -->
    <div class="text-center mt-4">
        <form action="{{ route('decision.process') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Lihat Ranking</button>
        </form>
    </div>
</div>
@endsection
