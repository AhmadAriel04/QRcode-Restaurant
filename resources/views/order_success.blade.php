<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <div class="card shadow p-5">
        <h3>Pesanan Berhasil!</h3>
        <p>Nomor Pesanan: <strong>#{{ $order->id }}</strong></p>
        <p>Silakan tunggu pesanan Anda diproses.</p>
        <form action="{{ route('payment.qris', $order->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary w-100">
        Bayar dengan QRIS
            </button>
        </form>
    </div>
</div>

</body>
</html>
