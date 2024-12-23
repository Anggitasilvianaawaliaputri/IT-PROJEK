@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Transaksi</h2>

    <!-- Form to edit the transaction -->
    <form action="{{ route('sale.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_karyawan" class="form-label">Nama Karyawan:</label>
            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="{{ $transaction->nama_karyawan }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang:</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $transaction->nama_barang }}" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $transaction->tanggal}}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $transaction->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah:</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $transaction->jumlah}}" required>
        </div>
        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal:</label>
            <input type="number" class="form-control" id="subtotal" name="subtotal" value="{{ $transaction->subtotal }}" readonly>
        </div>
        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                <option value="Cash" {{ $transaction->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Transfer" {{ $transaction->payment_method == 'Transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Transaksi</button>
    </form>
</div>
<script>

    document.getElementById('jumlah').addEventListener('input', calculateSubtotal);
    document.getElementById('harga').addEventListener('input', calculateSubtotal);

    function calculateSubtotal() {
        const harga = parseFloat(document.getElementById('harga').value) || 0;
        const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
        const subtotal = harga * jumlah;
        document.getElementById('subtotal').value = subtotal;
    }
</script>

@endsection