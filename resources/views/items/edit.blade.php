@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Edit Item</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="post" action="{{ route('proc.items.update', $item) }}">
    @csrf
    @method('PUT')

    <div class="mb-2">
      <label class="form-label">Nama</label>
      <input class="form-control" name="name"
             value="{{ old('name', $item->name) }}" placeholder="Nama" required>
    </div>

    <div class="mb-2">
      <label class="form-label">SKU</label>
      <input class="form-control" name="sku"
             value="{{ old('sku', $item->sku) }}" placeholder="SKU">
    </div>

    <div class="mb-3">
      <label class="form-label">Unit</label>
      <input class="form-control" name="unit"
             value="{{ old('unit', $item->unit) }}" placeholder="pcs/box/dll" required>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('proc.items.index') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection
