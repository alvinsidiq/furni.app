<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\XenditWebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Static Pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');



/*
|--------------------------------------------------------------------------
| Webhooks (Public, no auth)
|--------------------------------------------------------------------------
*/
Route::post('/webhook/xendit/invoice', [XenditWebhookController::class, 'handleInvoice'])
    ->name('xendit.webhook.invoice');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{furniture}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/store/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed', [CheckoutController::class, 'failed'])->name('checkout.failed');
    Route::get('/checkout/status/{order}', [CheckoutController::class, 'checkPaymentStatus'])
        ->name('checkout.status');

    // Orders
    Route::resource('orders', OrderController::class)->except(['create', 'store']);
    Route::get('/orders/create/{cart?}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    // Shop (public routes)
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/shop/{furniture}', [ShopController::class, 'show'])->name('shop.show');
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Thank You Page
    Route::get('/thankyou', function () {
        return view('thankyou');
    })->name('thankyou');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');