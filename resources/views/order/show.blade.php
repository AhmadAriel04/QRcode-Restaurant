@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Detail Pesanan</h4>
        </div>

        <div class="card-body">

            {{-- STATUS --}}
            <div class="mb-3">
                <span class="fw-bold">Status Pembayaran:</span>

                @if($order->payment_status == 'pending')
                    <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                @elseif($order->payment_status == 'paid')
                    <span class="badge bg-success">Sudah Dibayar</span>
                @elseif($order->payment_status == 'failed')
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </div>

            {{-- INFORMASI ORDER --}}
            <table class="table table-bordered">
                <tr>
                    <th>No Order</th>
                    <td>#{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>Meja</th>
                    <td>{{ $order->table_number ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Pemesan</th>
                    <td>{{ $order->customer_name }}</td>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ strtoupper($order->payment_method) }}</td>
                </tr>
            </table>

            {{-- BUKTI PEMBAYARAN --}}
            @if($order->payment_proof)
                <div class="mt-4">
                    <h5>Bukti Pembayaran</h5>
                    <img src="{{ asset('storage/'.$order->payment_proof) }}"
                         class="img-fluid rounded border"
                         style="max-width:300px;">
                </div>
            @endif

            {{-- STATUS INFO --}}
            <div class="alert alert-info mt-4">
                @if($order->payment_status == 'pending')
                    ⏳ Pesanan Anda sedang menunggu konfirmasi kasir.
                @elseif($order->payment_status == 'paid')
                    ✅ Pembayaran berhasil. Pesanan sedang diproses.
                @else
                    ⏳ Pesanan Anda sedang di proses menunggu konfirmasi kasir. 
                @endif
            </div>

            {{-- TOMBOL KEMBALI --}}
            <div class="mt-3">
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    Kembali ke Menu
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
