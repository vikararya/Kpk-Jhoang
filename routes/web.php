<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\UntukUserController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

// Rute untuk dashboard dengan middleware 'auth' dan 'verified'
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute untuk menu dan cart untuk user
Route::get('/menu', [UserMenuController::class, 'index'])->name('user.menu');
Route::post('/cart', [UserCartController::class, 'store'])->name('user.cart.store');
Route::get('/cart/checkout', [UserCartController::class, 'checkout'])->name('user.cart.checkout');
Route::post('/cart/process', [UserCartController::class, 'process'])->name('user.cart.process');
Route::post('/calculate-shipping', [UserCartController::class, 'calculateShipping']);
Route::get('/orderan', [OrderController::class, 'myOrders'])->name('orders.my');
Route::get('/orderan', [OrderController::class, 'myOrders'])->name('orders.my');
Route::get('/saran', [SaranController::class, 'create'])->name('saran.create');
Route::get('/review', [ReviewController::class, 'index']);
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');








// Rute yang memerlukan autentikasi untuk admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');

    
    // Route untuk kategori
    Route::resource('/categories', CategoryController::class);
    // Route untuk menu
    Route::resource('/menus', MenuController::class);
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');

    Route::resource('orders', OrderController::class);
    // Route untuk menyimpan tampilan (logo & image)
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::patch('/orders/{id}/approve', [OrderController::class, 'approve'])->name('orders.approve');
Route::patch('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
Route::patch('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
Route::get('/orders/history', [OrderHistoryController::class, 'history'])->name('orders.history');


Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::patch('/orders/{id}/delivery-status', [OrderController::class, 'updateDeliveryStatus'])->name('orders.updateDeliveryStatus');
Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::resource('untukuser', UntukUserController::class);Route::get('/untukuser/{id}/edit', [UntukUserController::class, 'edit'])->name('untukuser.edit');
Route::put('/untukuser/{untukuser}', [UntukUserController::class, 'update'])->name('untukuser.update');
Route::resource('rekening', RekeningController::class);
Route::get('/saran', [SaranController::class, 'index'])->name('saran.index');
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');
Route::get('/saran', [SaranController::class, 'index'])->name('saran.index');
Route::delete('/saran/{id}', [SaranController::class, 'destroy'])->name('saran.destroy');



});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [LandingController::class, 'index'])->name('landing');


require __DIR__.'/auth.php';

