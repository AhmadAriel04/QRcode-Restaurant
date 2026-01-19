<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Restaurant QR Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">🍽️ Restaurant</a>
        <a href="{{ route('cart.index') }}" class="btn btn-warning">
            🛒 Keranjang
        </a>
    </div>
</nav>

<div class="container">
    @include('components.alert')
    @yield('content')
</div>

</body>
</html>
