@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Laporan Pendapatan</h1>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Hasil Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pendapatan->tanggal_awal }} - {{ $pendapatan->tanggal_akhir }}</td>
                <td>Rp {{ is_numeric($pendapatan->pendapatan) ? number_format($pendapatan->pendapatan, 0, ',', '.') : '0' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Tombol untuk mencetak laporan -->
    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Cetak Laporan</button>
    </div>

    <!-- Tombol Kembali ke Laporan -->
    <div class="text-center mt-4">
        <a href="{{ route('report.index') }}" class="btn btn-secondary">Kembali ke Laporan</a>
    </div>
</div>
@endsection
