@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Quotation Supplier – Need #{{ $need->id }}</h3>

  <div class="row">
    @foreach($quotes as $q)
    <div class="col-md-6">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">{{ $q->supplier->name }}</h5>
          <div class="text-muted">Quote Num: {{ $q->quote_num ?? '-' }}</div>

          @php $grand = 0; @endphp

        <table class="table table-sm mt-3">
  <thead>
    <tr>
      <th>Item</th>
      <th class="text-end">Qty Need</th>
      <th class="text-end">Harga/pcs</th>
      <th class="text-end">Subtotal</th>
    </tr>
  </thead>
  <tbody>
  @php $grand = 0; @endphp
  @foreach($need->items as $ni)
    @php
      $qi    = $q->items->firstWhere('item_id', $ni->item_id);
      $price = $qi?->price ?? 0;

      // --- ambil "isi N" dari pack_info milik supplier ini ---
      $mult = 1;                // pcs per "box"
      if ($qi && $qi->pack_info && preg_match('/isi\s*(\d+)/i', $qi->pack_info, $m)) {
          $mult = max(1, (int)$m[1]);
      }

      // kalau kebutuhan di Need adalah "box", konversi ke pcs
      $isBox = strtolower($ni->item->unit ?? '') === 'box';
      $effectiveQty = $isBox ? ($ni->qty * $mult) : $ni->qty;

      $subtotal = $price * $effectiveQty;
      $grand   += $subtotal;
    @endphp
    <tr>
      <td>
        {{ $ni->item->name }}
        @if($qi?->pack_info)
          <div class="text-muted small">Pack: {{ $qi->pack_info }}</div>
        @endif
      </td>
      <td class="text-end">
        {{ rtrim(rtrim(number_format($ni->qty,2,',','.'), '0'), ',') }}
        {{ $ni->item->unit }}
        @if($isBox)
          <div class="text-muted small">=&nbsp;{{ number_format($effectiveQty,0,',','.') }} pcs</div>
        @endif
      </td>
      <td class="text-end">{{ $qi ? number_format($price,0,',','.') : '-' }}</td>
      <td class="text-end">{{ $qi ? number_format($subtotal,0,',','.') : '-' }}</td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th colspan="3" class="text-end">TOTAL</th>
      <th class="text-end">{{ number_format($grand,0,',','.') }}</th>
    </tr>
  </tfoot>
</table>


          <form method="post" action="{{ route('proc.compare.choose', $need) }}" class="mt-2">
            @csrf
            <input type="hidden" name="quote_id" value="{{ $q->id }}">
            <input class="form-control mb-2" name="shipping_method" placeholder="Pengiriman (Diambil / Dikirim)">
            <input class="form-control mb-3" name="payment_method" placeholder="Pembayaran (Tunai / Cicilan / Credit Card)">
            <button class="btn btn-primary w-100">Pilih & Buat PO</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <a href="{{ route('proc.needs.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
