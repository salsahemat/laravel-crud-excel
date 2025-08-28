@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Quotes</h3>
  <a class="btn btn-primary mb-2" href="{{ route('proc.quotes.create') }}">Buat Quote</a>
  <table class="table table-bordered">
    <thead><tr><th>Supplier</th><th>Quote Num</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($quotes as $q)
      <tr>
        <td>{{ $q->supplier->name }}</td>
        <td>{{ $q->quote_num }}</td>
        <td>{{ $q->status }}</td>
        <td><a class="btn btn-sm btn-warning" href="{{ route('proc.quotes.edit',$q) }}">Isi Harga</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $quotes->links() }}
</div>
@endsection
