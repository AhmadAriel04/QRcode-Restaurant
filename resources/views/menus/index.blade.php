@extends('layouts.app')

@section('content')
<h4 class="mb-3">📋 Daftar Menu</h4>

<div class="row">
@foreach($menus as $menu)
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5>{{ $menu->name }}</h5>
                <p>Rp {{ number_format($menu->price) }}</p>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
