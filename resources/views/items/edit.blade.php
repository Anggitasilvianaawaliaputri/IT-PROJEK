@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Edit Barang</h1>

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input Nama Barang -->
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $item->nama_barang }}" required>
        </div>

        <!-- Input Harga -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $item->harga }}" required>
        </div>

        <!-- Input Jumlah -->
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $item->jumlah }}" required>
        </div>

        <!-- Input Netto -->
        <div class="form-group">
            <label for="netto">Netto (gram):</label>
            <input type="number" name="netto" id="netto" value="{{ old('netto', $item->netto ?? '') }}" class="form-control" required>
        </div>
        <!-- Dropdown Kategori -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input Gambar -->
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            @if($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_barang }}" class="img-thumbnail mt-2" width="100">
            @endif
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
