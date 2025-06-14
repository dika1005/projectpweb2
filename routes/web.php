<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/orders/history', [AdminController::class, 'historyOrders'])->name('admin.orders.history');


    Route::prefix('admin/products')->name('admin.product.')->group(function () {
        Route::get('/', [AdminController::class, 'productIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'productCreate'])->name('create');
        Route::post('/', [AdminController::class, 'productStore'])->name('store');
        Route::get('/{product}/edit', [AdminController::class, 'productEdit'])->name('edit');
        Route::put('/{product}', [AdminController::class, 'productUpdate'])->name('update');
        Route::delete('/{product}', [AdminController::class, 'productDestroy'])->name('destroy');
    });
});

Route::middleware('auth')->group(function () {
    // Halaman daftar produk
    Route::get('/produk', [UserController::class, 'showProducts'])->name('home.products');

    // Form & proses pemesanan
    Route::get('/pesan/{product}', [UserController::class, 'orderForm'])->name('orders.create');
    Route::post('/pesan/{product}', [UserController::class, 'storeOrder'])->name('orders.store');

    // Lihat pesanan user
    Route::get('/pesanan-saya', [UserController::class, 'myOrders'])->name('orders.my');

    Route::get('/orders/history', [UserController::class, 'historyOrders'])->name('orders.history');
});




require __DIR__ . '/auth.php';
