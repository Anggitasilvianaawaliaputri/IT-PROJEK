@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Ranking Produk Terbaik</h1>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Total Jumlah</th>
                <th>Netto</th>
                <th>Nilai SAW</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_tpk as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->total_jumlah }}</td>
                    <td>{{ number_format($item->netto, 0, ',', '.') }}</td>
                    <td>{{ number_format($item->saw_value, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
