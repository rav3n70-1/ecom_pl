<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/category/{category:slug}', [ProductController::class, 'category'])->name('products.category');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Products Management
    Route::get('/products', [App\Http\Controllers\AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [App\Http\Controllers\AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('products.delete');
    
    // Categories Management
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('categories');
    
    // Orders Management
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('orders');
    Route::put('/orders/{order}/status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('orders.update-status');
});

require __DIR__.'/auth.php';
