@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Tambah Supplier</h3>
  <form method="post" action="{{ route('proc.suppliers.store') }}">@csrf
    <input class="form-control mb-2" name="name" placeholder="Nama" required>
    <input class="form-control mb-2" name="contact_name" placeholder="Contact person">
    <input class="form-control mb-2" name="phone" placeholder="Phone">
    <input class="form-control mb-2" name="email" placeholder="Email">
    <textarea class="form-control mb-2" name="address" placeholder="Alamat"></textarea>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('proc.suppliers.index') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection