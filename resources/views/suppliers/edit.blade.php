@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Edit Supplier</h3>
  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
  <form method="post" action="{{ route('proc.suppliers.update',$supplier) }}">@csrf @method('PUT')
    <input class="form-control mb-2" name="name" value="{{ $supplier->name }}" required>
    <input class="form-control mb-2" name="contact_name" value="{{ $supplier->contact_name }}">
    <input class="form-control mb-2" name="phone" value="{{ $supplier->phone }}">
    <input class="form-control mb-2" name="email" value="{{ $supplier->email }}">
    <textarea class="form-control mb-2" name="address">{{ $supplier->address }}</textarea>
    <button class="btn btn-success">Update</button>
    <a href="{{ route('proc.suppliers.index') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection
