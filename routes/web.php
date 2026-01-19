<?php

use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\QrController;

/*
|--------------------------------------------------------------------------
| CUSTOMER FLOW
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| QR CODE (SCAN DI MEJA)
|--------------------------------------------------------------------------
*/
Route::get('/table/{number}', [HomeController::class, 'setTable'])
    ->name('table.qr');

Route::get('/qr/{table}', [QrController::class, 'show'])->name('qr.show');

Route::get('/admin/qr/pdf', [QrController::class, 'generatePdf'])
    ->name('qr.pdf');

// === HALAMAN UTAMA ===

Route::get('/home', [HomeController::class, 'index'])->name('home.index');


/*
|--------------------------------------------------------------------------
| MENU & CATEGORY
|--------------------------------------------------------------------------
*/

// === MENU ===
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/category/{categoryId}', [MenuController::class, 'byCategory'])->name('menus.category');
Route::get('/menus/{id}', [MenuController::class, 'show'])->name('menus.show');

// === CATEGORY ===
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{menuId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


/*
|--------------------------------------------------------------------------
| ORDER & CHECKOUT
|--------------------------------------------------------------------------
*/

Route::post('/checkout', [CheckoutController::class, 'checkout'])
    ->name('checkout');

Route::get('/checkout', function () {
    return redirect()->route('cart.index');
});

Route::get('/order/{order}', [OrderController::class, 'show'])
    ->name('order.show');

Route::get('/orders/history', [OrderController::class, 'history'])
    ->name('orders.history');


/*
|--------------------------------------------------------------------------
| PAYMENT (QRIS STATIS)
|--------------------------------------------------------------------------
*/

Route::get('/payment/qris/{order}', [PaymentController::class, 'showQris'])
    ->name('payment.qris');

Route::get('/payment/cash/{order}', [PaymentController::class, 'cash'])
    ->name('payment.cash');

Route::post('/payment/confirm', [PaymentController::class, 'confirm'])
    ->name('payment.confirm');


/*
|--------------------------------------------------------------------------
| ADMIN / KASIR
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/orders', [OrderController::class, 'adminIndex'])
        ->name('admin.orders');

    Route::post('/payment/{payment}/approve', [PaymentController::class, 'approve'])
        ->name('admin.payment.approve');

    Route::post('/payment/{payment}/reject', [PaymentController::class, 'reject'])
        ->name('admin.payment.reject');
});


/*
|--------------------------------------------------------------------------
| UTILITIES
|--------------------------------------------------------------------------
*/

// CLEAR SESSION (DEV ONLY)
Route::get('/clear-session', function () {
    session()->forget('table_number');
    return 'Session meja sudah dihapus!';
})->name('session.clear');