@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Dashboard</h1>

  {{-- Ringkasan --}}
  <div class="row g-3 mb-4">
    <div class="col-md-2"><div class="card text-center"><div class="card-body"><div class="h5 mb-0">{{ $summary['suppliers'] }}</div><small>Suppliers</small></div></div></div>
    <div class="col-md-2"><div class="card text-center"><div class="card-body"><div class="h5 mb-0">{{ $summary['items'] }}</div><small>Items</small></div></div></div>
    <div class="col-md-2"><div class="card text-center"><div class="card-body"><div class="h5 mb-0">{{ $summary['needs'] }}</div><small>Needs</small></div></div></div>
    <div class="col-md-2"><div class="card text-center"><div class="card-body"><div class="h5 mb-0">{{ $summary['quotes'] }}</div><small>Quotes</small></div></div></div>
    <div class="col-md-2"><div class="card text-center"><div class="card-body"><div class="h5 mb-0">{{ $summary['pos'] }}</div><small>POs</small></div></div></div>
  </div>

  {{-- Menu Utama --}}
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-body">
          <h5>Procurement — Quotation → PO → Receipt</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="border rounded p-3 h-100">
                <h6 class="mb-2">Master</h6>
                <a class="btn btn-primary w-100 mb-2" href="{{ route('proc.suppliers.index') }}">Suppliers</a>
                <a class="btn btn-primary w-100" href="{{ route('proc.items.index') }}">Items</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="border rounded p-3 h-100">
                <h6 class="mb-2">Operasional</h6>
                <div class="d-grid gap-2">
                  <a class="btn btn-outline-primary" href="{{ route('proc.needs.index') }}">Needs (Upload CSV)</a>
                  <a class="btn btn-outline-primary" href="{{ route('proc.quotes.index') }}">Quotes</a>
                  <a class="btn btn-outline-primary" href="{{ route('proc.pos.index') }}">Purchase Orders</a>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-3">

          <h6>Quick Actions</h6>
          <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-secondary" href="{{ route('proc.needs.create') }}">Upload CSV Need</a>
            <a class="btn btn-secondary" href="{{ route('proc.quotes.create') }}">Buat Quote</a>
            <a class="btn btn-secondary" href="{{ route('proc.suppliers.create') }}">Tambah Supplier</a>
            <a class="btn btn-secondary" href="{{ route('proc.items.create') }}">Tambah Item</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
