@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Purchase Orders</h3>
  <table class="table table-bordered">
    <thead><tr><th>PO#</th><th>Supplier</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($pos as $po)
      <tr>
        <td>{{ $po->po_num }}</td>
        <td>{{ $po->supplier->name }}</td>
        <td>{{ $po->status }}</td>
        <td><a class="btn btn-sm btn-info" href="{{ route('proc.pos.show',$po) }}">Detail</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $pos->links() }}
</div>
@endsection
