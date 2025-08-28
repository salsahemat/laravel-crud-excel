@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Tambah Items</h3>
  <form method="post" action="{{ route('proc.items.store') }}">@csrf
    <input class="form-control mb-2" name="name" placeholder="Nama" required>
    <input class="form-control mb-2" name="sku" placeholder="SKU">
    <input class="form-control mb-2" name="unit" placeholder="Unit">
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('proc.items.index') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection