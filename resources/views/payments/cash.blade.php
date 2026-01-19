@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow p-4">
        <h4>💵 Pembayaran Cash</h4>

        <p class="mt-3">
            Silakan lakukan pembayaran langsung ke kasir.
        </p>

        <p class="text-muted">
            Nomor Pesanan: <strong>#{{ $order->id }}</strong>
        </p>

        <p class="text-muted">
            Nama Pemesan: <strong>{{ $order->customer_name }}</strong>
        </p>

        <div class="alert alert-warning mt-3">
            Menunggu konfirmasi dari kasir...
        </div>

        <a href="{{ route('home.index') }}" class="btn btn-secondary mt-3">
            Kembali ke Menu
        </a>
    </div>
</div>
@endsection
