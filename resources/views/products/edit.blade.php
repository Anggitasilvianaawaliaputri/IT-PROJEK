@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Produk</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $product->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Produk</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $product->harga }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="submit" class="btn btn-primary">Batal</button>
    </form>
</div>
@endsection
