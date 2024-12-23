@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Laporan Penjualan</h1>
    
    <a href="{{ route('report.create') }}" class="btn btn-primary mb-3">Tambah Laporan</a>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped table-bordered">
        <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Pendapatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $index => $report) <!-- Ganti $reports menjadi $laporan -->
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->nama_karyawan }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->tanggal)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($report->pendapatan, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('report.edit', $report->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('report.destroy', $report->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Menghilangkan notifikasi setelah 5 detik
    window.onload = function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(function() {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        }
    };
</script>
@endsection