@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Items</h3>
  <a class="btn btn-primary mb-2" href="{{ route('proc.items.create') }}">Tambah</a>
  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
  <table class="table table-bordered">
    <thead><tr><th>Nama</th><th>SKU</th><th>Unit</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($data as $s)
        <tr>
          <td>{{ $s->name }}</td><td>{{ $s->sku }}</td><td>{{ $s->unit }}</td>
          <td>
            <a class="btn btn-sm btn-warning" href="{{ route('proc.items.edit',$s) }}">Edit</a>
            <form action="{{ route('proc.items.destroy',$s) }}" method="POST" style="display:inline">@csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $data->links() }}
</div>
@endsection
