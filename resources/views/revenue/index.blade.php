@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Hitung Pendapatan</h1>

    <!-- Card untuk Formulir -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('revenue.index') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Hitung Pendapatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection