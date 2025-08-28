@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Penerimaan Barang — {{ $po->po_num }}</h3>
  <form method="post" action="{{ route('proc.receipts.store',$po) }}">@csrf
    <table class="table">
      <thead><tr><th>Item</th><th>Dipesan</th><th>Terima</th></tr></thead>
      <tbody>
        @foreach($po->items as $it)
          <tr>
            <td>{{ $it->item->name }}</td>
            <td>{{ $it->qty }} {{ $it->item->unit }}</td>
            <td><input class="form-control" type="number" step="0.01" name="items[{{ $it->item_id }}]" value="{{ $it->qty }}"></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <button class="btn btn-primary">Simpan Penerimaan</button>
    <a href="{{ route('proc.pos.show', $po) }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection
