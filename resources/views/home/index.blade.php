<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- #region -->

<style>
    .category-tabs {
        position: sticky;
        top: 0;
        z-index: 999;
        background-color: #ffffff;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        display: flex;
        gap: 8px;
        overflow-x: auto;
    }

    .category-tabs::-webkit-scrollbar {
    display: none;
    }

    .category-tabs button {
        background-color: #6d6d74ff;   /* WARNA TAB */
        color: #333;
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .category-tabs button.active {
        background: #198754;
        color: #fff;
    }

    .menu-section {
        scroll-margin-top: 120px;
    }

    .menu-card {
        border-radius: 14px;
        background: #fff;
        padding: 14px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }

    .menu-title {
        font-size: 15px;
        font-weight: 600;
    }

    .menu-price {
        color: #1e9d57;
        font-weight: 600;
        font-size: 14px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background: #fff;
    }

    .add-btn {
        background: #198754;
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
        border: none;
    }

    .category-title {
        font-weight: 700;
        margin-top: 20px;
        margin-bottom: 10px;
        font-size: 18px;
    }
</style>

<div class="container pb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Meja {{ $tableNumber }}</h5>
        <a href="{{ route('cart.index') }}" class="btn btn-success btn-sm">
            🛒 Keranjang
        </a>
    </div>

    <div class="category-tabs">
    @foreach($categories as $category)
        <button id="tab-{{ $category->id}}"
                onclick="scrollToCategory('{{ $category->id }}')">
            {{ $category->name }}
        </button>
    @endforeach
</div>

    <div class="container pb-5">
    @foreach ($categories as $category)
        <div class="menu-section" id="category-{{ $category->id }}">
            <h5 class="category-title">{{ $category->name }}</h5>

            @foreach ($category->menus as $menu)
                <div class="menu-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="menu-title">{{ $menu->name }}</div>
                            <div class="menu-price">Rp {{ number_format($menu->price) }}</div>
                        </div>

                        <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <button type="button" class="qty-btn" onclick="changeQty('{{ $menu->id }}', -1)">−</button>
                            <input type="number" id="qty-{{ $menu->id }}" value="1" class="form-control mx-1" style="width:50px">
                            <button type="button" class="qty-btn" onclick="changeQty('{{ $menu->id }}', 1)">+</button>
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="add-btn ms-2">+</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>


<script>
function changeQty(id, delta) {
    let input = document.getElementById('qty-' + id);
    let val = parseInt(input.value) || 1;
    if (val + delta >= 1) input.value = val + delta;
}

function scrollToCategory(id) {
    document.getElementById('category-' + id)
        .scrollIntoView({ behavior: 'smooth' });

    document.querySelectorAll('.category-tabs button')
        .forEach(btn => btn.classList.remove('active'));

    document.getElementById('tab-' + id).classList.add('active');
}
</script>
