@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Produk</h1>
    
    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <table class="table table-striped table-bordered">
        <table class="table table-bordered text-center">
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $product->nama }}</td>
        <td>{{ $product->harga }}</td>
        <td>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
</div>
@endsection
