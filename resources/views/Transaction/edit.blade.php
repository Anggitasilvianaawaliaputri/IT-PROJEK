@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>
    
    <!-- Tampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk mengedit transaksi -->
    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Pemilik</label>
            <input 
                type="text" 
                name="customer_name" 
                id="customer_name" 
                class="form-control" 
                value="{{ old('customer_name', $transaction->customer_name) }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="item_name" class="form-label">Nama Barang</label>
            <input 
                type="text" 
                name="item_name" 
                id="item_name" 
                class="form-control" 
                value="{{ old('item_name', $transaction->item_name) }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input 
                type="number" 
                name="quantity" 
                id="quantity" 
                class="form-control" 
                value="{{ old('quantity', $transaction->quantity) }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input 
                type="number" 
                name="price" 
                id="price" 
                class="form-control" 
                value="{{ old('price', $transaction->price) }}" 
                step="0.01" 
                required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection