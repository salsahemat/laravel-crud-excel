<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Procurement App</a>
    <div class="navbar-nav">
      <a class="nav-link" href="{{ route('proc.needs.index') }}">Needs</a>
      <a class="nav-link" href="{{ route('proc.quotes.index') }}">Quotes</a>
      <a class="nav-link" href="{{ route('proc.pos.index') }}">PO</a>
      <a class="nav-link" href="{{ route('proc.suppliers.index') }}">Suppliers</a>
      <a class="nav-link" href="{{ route('proc.items.index') }}">Items</a>
    </div>
  </div>
</nav>

    {{-- Isi Halaman --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
