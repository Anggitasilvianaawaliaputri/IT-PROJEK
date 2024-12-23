@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Tambah Barang</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input Nama Barang -->
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>

        <!-- Input Harga -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>

        <!-- Input Jumlah -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        <!-- Input Netto -->
        <div class="mb-3">
            <label for="netto" class="form-label">Netto (gr)</label>
            <input type="number" class="form-control" id="netto" name="netto" value="{{ old('netto', $item->netto ?? '') }}" required>
        </div>

        <!-- Dropdown Kategori -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input Gambar -->
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
