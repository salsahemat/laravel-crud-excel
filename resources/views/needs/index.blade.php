@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Needs (Batch Kebutuhan)</h3>
  <a class="btn btn-primary mb-2" href="{{ route('proc.needs.create') }}">Upload CSV</a>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Diupload</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($needs as $n)
      <tr>
        <td>{{ $n->id }}</td>
        <td>{{ $n->created_at }}</td>
        <td><a class="btn btn-sm btn-info" href="{{ route('proc.compare.show',$n) }}">Bandingkan Quotes</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $needs->links() }}
</div>
@endsection
