@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Buat Quote</h3>
  <form method="post" action="{{ route('proc.quotes.store') }}">@csrf
    <input class="form-control mb-2" name="quote_num" placeholder="Quote Num (opsional)">
    <select name="supplier_id" class="form-select mb-2" required>
      <option value="">-- Pilih Supplier --</option>
      @foreach($suppliers as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach
    </select>
    <button class="btn btn-primary">Lanjut</button>
    <a href="{{ route('proc.quotes.index') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection
