@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Quote {{ $quote->quote_num ?? '#'.$quote->id }} — {{ $quote->supplier->name }}</h3>

  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

  <form method="post" action="{{ route('proc.quotes.update',$quote) }}">@csrf @method('PUT')
    <div class="row g-2 mb-2">
      <div class="col"><input class="form-control" name="shipping_method" value="{{ $quote->shipping_method }}" placeholder="Pengiriman (Diambil / dikirim)"></div>
      <div class="col"><input class="form-control" name="payment_method" value="{{ $quote->payment_method }}" placeholder="Pembayaran (Tunai / Cicilan / CC)"></div>
    </div>
    <button class="btn btn-secondary">Simpan Header</button>
  </form>

  <hr>
  <h5>Tambah Item Harga</h5>
  <form method="post" action="{{ route('proc.quotes.items.store',$quote) }}" class="row g-2">@csrf
    <div class="col-6">
      <select name="item_id" class="form-select">
        @foreach($items as $it)<option value="{{ $it->id }}">{{ $it->name }} ({{ $it->unit }})</option>@endforeach
      </select>
    </div>
    <div class="col-3"><input class="form-control" name="price" type="number" step="0.01" placeholder="Harga/pcs"></div>
    <div class="col-3"><input class="form-control" name="pack_info" placeholder="1 box isi 12 (opsional)"></div>
    <div class="col-12 mt-2"><button class="btn btn-primary">Tambah/Update</button></div>
  </form>

  <table class="table table-sm mt-3">
    <thead><tr><th>Item</th><th>Harga/pcs</th><th>Keterangan</th></tr></thead>
    <tbody>
      @foreach($quote->items as $qi)
      <tr><td>{{ $qi->item->name }}</td><td>{{ number_format($qi->price) }}</td><td>{{ $qi->pack_info }}</td></tr>
      @endforeach
    </tbody>
  </table>

  <a href="{{ route('proc.quotes.index') }}" class="btn btn-secondary">Back</a>

</div>
@endsection
