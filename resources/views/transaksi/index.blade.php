@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Transaksi</h1>

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Aksi --}}
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Tambah Manual</a>
        <a href="{{ route('transaksi.import') }}" class="btn btn-secondary">Import Excel</a>
        <a href="{{ url('/transaksi/export-excel') }}" class="btn btn-success">Export Excel</a>
        <a href="{{ url('/transaksi/export-pdf') }}" class="btn btn-danger">Export PDF</a>
    </div>

    {{-- Tabel Data --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode Toko</th>
                <th>Nominal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
<tbody>
    @forelse($transaksi as $index => $t)
        <tr>
            <td>{{ $t->kode_toko }}</td>
            <td>Rp {{ number_format($t->nominal_transaksi, 2, ',', '.') }}</td>
            <td>
                <a href="{{ route('transaksi.edit', $t->kode_toko) }}" class="btn btn-sm btn-warning">Edit</a>


                <form action="{{ route('transaksi.destroy',  $t->kode_toko) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">Tidak ada data</td>
        </tr>
    @endforelse
</tbody>

    </table>
</div>
@endsection
