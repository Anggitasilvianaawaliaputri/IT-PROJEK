@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Tambah Transaksi</h1>
    <form action="{{ route('sale.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Cari nama barang..." required>
        </div>
            
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="netto">Netto</label>
            <input type="text" name="netto" class="form-control" step="0.01" value="{{ old('netto', $item->netto ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-select" required>
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ route('sale.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<!-- jQuery dan jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<script>
$(document).ready(function() {
    $("#nama_barang").autocomplete({
        source: "{{ route('sale.autocomplete') }}", // Route untuk mencari data
        minLength: 1
    });
});
</script>
@endsection