@extends('layouts.app')
@section('content')
<div class="container">
  <h3>PO {{ $po->po_num }}</h3>

  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

  <p>
    Supplier: <b>{{ $po->supplier->name }}</b><br>
    Pengiriman: {{ $po->shipping_method }} |
    Pembayaran: {{ $po->payment_method }}<br>
    Status: <span class="badge bg-secondary text-uppercase">{{ $po->status }}</span>
  </p>

  <div class="mb-3">
    @if($po->status === 'draft')
      <form class="d-inline" method="post" action="{{ route('proc.pos.submit',$po) }}">@csrf
        <button class="btn btn-secondary">Submit</button>
      </form>
    @elseif($po->status === 'submitted')
      <form class="d-inline" method="post" action="{{ route('proc.pos.approve',$po) }}">@csrf
        <button class="btn btn-success">Approve</button>
      </form>
    @endif

    {{-- Aksi setelah APPROVED / EMAILED --}}
    @if(in_array($po->status, ['approved','emailed']))
      <a class="btn btn-outline-primary" href="{{ route('proc.pos.pdf',$po) }}">Download PDF</a>
      <a class="btn btn-outline-secondary" href="{{ route('proc.pos.csv',$po) }}">Export CSV</a>

      <form class="d-inline" method="post" action="{{ route('proc.pos.email',$po) }}">@csrf
        <button class="btn btn-warning" {{ $po->status === 'emailed' ? 'disabled' : '' }}>
          {{ $po->status === 'emailed' ? 'Email Terkirim' : 'Email Supplier' }}
        </button>
      </form>

      <a class="btn btn-info" href="{{ route('proc.receipts.create',$po) }}">Terima Barang</a>
    @endif
  </div>

  <table class="table table-sm">
    <thead>
      <tr><th>No</th><th>Item</th><th>Qty</th><th>Sat</th><th>Harga</th><th>Subtotal</th></tr>
    </thead>
    <tbody>
      @foreach($po->items as $i=>$it)
      <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $it->item->name }}</td>
        <td>{{ $it->qty }}</td>
        <td>{{ $it->item->unit }}</td>
        <td>{{ number_format($it->unit_price) }}</td>
        <td>{{ number_format($it->subtotal) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <a href="{{ route('proc.pos.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
