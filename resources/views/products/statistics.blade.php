@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Statistik Sistem Pengambilan Keputusan</h1>

    <div class="row mt-4">
        <!-- Card untuk jumlah produk -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk</h5>
                    <p class="card-text">{{ $totalProducts ?? 'Data tidak tersedia' }}</p>
                </div>
            </div>
        </div>

        <!-- Card untuk rata-rata skor produk -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rata-rata Skor Produk</h5>
                    <p class="card-text">{{ isset($averageScore) ? number_format($averageScore, 2) : 'Data tidak tersedia' }}</p>
                </div>
            </div>
        </div>

        <!-- Card untuk distribusi bobot kriteria -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Distribusi Bobot Kriteria</h5>
                    <ul>
                        @if(isset($criteria) && $criteria->count() > 0)
                            @foreach ($criteria as $criterion)
                                <li>{{ $criterion->name }}: {{ number_format($criterion->weight, 2) }}</li>
                            @endforeach
                        @else
                            <li class="text-danger">Data kriteria tidak ditemukan.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel untuk ranking produk teratas -->
    <h3 class="mt-5">Ranking Produk Teratas</h3>
        <table class="table table-striped table-bordered">
            <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Nama Produk</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($ranking) && $ranking->count() > 0)
                @foreach ($ranking as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>{{ number_format($product->score, 2) }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center text-danger">Data produk tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
