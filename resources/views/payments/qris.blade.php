@extends('layouts.app')

@section('content')
<h4 class="mb-3">💳 Pembayaran QRIS</h4>

<div class="card text-center">
    <div class="card-body">
        <p>Silakan scan QRIS di bawah ini</p>

        <img src="{{ asset('images/qris.jpg') }}"
             alt="QRIS"
             width="250">

        <p class="mt-3">
            Total Pembayaran:
            <strong>Rp {{ number_format($payment->amount) }}</strong>
        </p>

        <form action="{{ route('payment.confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="mb-3">
        <label>Upload Bukti Pembayaran</label>
        <input type="file" name="proof" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">
            Kirim Bukti Pembayaran
        </button>
    </form>
  </div>
</div>
@endsection
