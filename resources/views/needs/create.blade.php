@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Upload CSV Kebutuhan</h3>
  <div class="alert alert-secondary">Format: <code>line,item,qty,unit</code></div>
  <form method="post" action="{{ route('proc.needs.store') }}" enctype="multipart/form-data">@csrf
    <input type="file" name="file" class="form-control mb-2" accept=".csv" required>
    <button class="btn btn-primary">Upload</button>
    <a href="{{ route('proc.needs.index') }}" class="btn btn-secondary">Back</a>

  </form>
</div>
@endsection
