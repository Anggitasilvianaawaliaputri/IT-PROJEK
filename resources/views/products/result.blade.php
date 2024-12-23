@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Judul Halaman -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-success">Hasil Perhitungan Ranking Produk</h1>
        <p class="text-muted">Berikut adalah hasil peringkat produk berdasarkan skor tertinggi</p>
    </div>

    <!-- Tabel Ranking -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-success text-white">
                    <tr>
                        <th style="width: 10%;">Ranking</th>
                        <th style="width: 40%;">Nama Produk</th>
                        <th style="width: 20%;">Skor</th>
                        <th style="width: 30%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranking as $key => $product)
                        <tr>
                            <td>
                                <span class="badge bg-success fs-6">{{ $key + 1 }}</span>
                            </td>
                            <td class="fw-semibold">{{ $product->nama }}</td>
                            <td class="fw-bold text-primary">{{ number_format($product->score, 2) }}</td>
                            <td>
                                @if ($product->score >= 70)
                                    <span class="text-success">Sangat Baik</span>
                                @elseif ($product->score >= 50)
                                    <span class="text-warning">Baik</span>
                                @else
                                    <span class="text-danger">Cukup</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="mt-4 text-center text-muted">
        <small>Data ini diurutkan berdasarkan skor produk tertinggi dalam sistem.</small>
    </div>
</div>
@endsection
