@extends('layouts.app')

@section('content')
<h4 class="mb-3">🛒 Keranjang Pesanan</h4>

@if($carts->isEmpty())
    <div class="alert alert-info">Keranjang kamu masih kosong nih yuk pesan menunya😍😍</div>
    <a href="{{ route('home.index') }}"
    class="btn btn-primary d-inline bottom-0 start-0 m-3 shadow">
    Pilih Menu
    </a>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Menu</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($carts as $cart)
            @php $grandTotal += $cart->total_price; @endphp
            <tr>
                <td>{{ $cart->menu->name }}</td>
                <td>Rp {{ number_format($cart->menu->price) }}</td>
                <td>
                    <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                        @csrf
                        <input type="number"
                               name="quantity"
                               value="{{ $cart->quantity }}"
                               min="1"
                               class="form-control"
                               onchange="this.form.submit()">
                    </form>
                </td>
                <td>Rp {{ number_format($cart->total_price) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h5>Total Bayar: <strong>Rp {{ number_format($grandTotal) }}</strong></h5>

<form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
    @csrf 
    @method('DELETE')
    <button class="btn btn-secondary">Kosongkan</button>
</form>

<a href="{{ route('home.index') }}"
   class="btn btn-primary d-inline bottom-0 start-0 m-3 shadow">
   Tambah Menu
</a>

<form action="{{ route('checkout') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-2">
        <label class="form-label">Metode Pembayaran</label>
        <select name="payment_method" class="form-select" required>
            <option value="qris">QRIS</option>
            <option value="cash">Cash</option>
        </select>
    </div>

    <div class="mb-2">
        <label class="form-label">Nama Pemesan</label>
        <input type="text" name="customer_name" class="form-control">
    </div>

    <button type="submit" class="btn btn-success w-100">
        Checkout & Bayar
    </button>
</form>
@endif
@endsection
