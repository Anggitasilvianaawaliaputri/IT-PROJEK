@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Judul Halaman -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-success">Hasil Perhitungan Ranking Barang</h1>
        <p class="text-muted">Berikut adalah hasil peringkat produk berdasarkan skor tertinggi</p>
    </div>

    <!-- Tabel Ranking -->
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Tambahkan table-responsive untuk responsivitas -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-success text-white">
                        <tr>
                            <th style="width: 10%;">Ranking</th>
                            <th style="width: 40%;">Nama Barang</th>
                            <th style="width: 20%;">Skor</th>
                            <th style="width: 30%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Penanganan data kosong -->
                        @if ($ranking->isEmpty())
                            <tr>
                                <td colspan="4" class="text-muted">Tidak ada data yang tersedia.</td>
                            </tr>
                        @else
                            @foreach ($ranking as $key => $product)
                                <tr>
                                    <!-- Tambahkan ikon pada ranking -->
                                    <td>
                                        @if ($key == 0)
                                            <span class="badge bg-success fs-6">🏆 {{ $key + 1 }}</span>
                                        @elseif ($key == 1)
                                            <span class="badge bg-secondary fs-6">🥈 {{ $key + 1 }}</span>
                                        @elseif ($key == 2)
                                            <span class="badge bg-warning fs-6">🥉 {{ $key + 1 }}</span>
                                        @else
                                            <span class="badge bg-success fs-6">{{ $key + 1 }}</span>
                                        @endif
                                    </td>
                                    <!-- Tooltip untuk nama barang -->
                                    <td class="fw-semibold" data-bs-toggle="tooltip" data-bs-placement="top" title="Klik untuk melihat detail barang">
                                        {{ $product->nama }}
                                    </td>
                                    <!-- Format skor dengan 2 desimal -->
                                    <td class="fw-bold text-primary">{{ number_format($product->score, 2) }}</td>
                                    <!-- Keterangan berdasarkan skor -->
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
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="mt-4 text-center text-muted">
        <small>Data ini diurutkan berdasarkan skor produk tertinggi dalam sistem.</small>
    </div>
</div>

<!-- Inisialisasi Tooltip Bootstrap -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
