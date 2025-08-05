@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Transaksi Baru</h1>

    {{-- Tampilkan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Input --}}
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kode_toko" class="form-label">Kode Toko</label>
            <input type="number" class="form-control" id="kode_toko" name="kode_toko" required>
        </div>

        <div class="mb-3">
            <label for="nominal_transaksi" class="form-label">Nominal Transaksi</label>
            <input type="number" step="0.01" class="form-control" id="nominal_transaksi" name="nominal_transaksi" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
