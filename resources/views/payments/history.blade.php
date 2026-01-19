@extends('layouts.app')

@section('content')
<h4 class="mb-3">📜 Riwayat Pembayaran</h4>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>#{{ $payment->id }}</td>
            <td>Rp {{ number_format($payment->amount) }}</td>
            <td>{{ strtoupper($payment->payment_method) }}</td>
            <td>
                <span class="badge bg-success">
                    {{ $payment->payment_status }}
                </span>
            </td>
            <td>{{ $payment->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
