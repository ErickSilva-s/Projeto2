<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    Route::resource('address', AddressController::class);
    Route::resource('user', ProfileController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');

    Route::get('/purchase-success', function () {
        return view('purchase-success');
    })->name('purchase.success');
    Route::post('/purchase-complete', [CartController::class, 'completePurchase'])->name('purchase.complete');


});
Route::resource('product', ProductController::class);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/review', [ProductController::class, 'submitReview'])->name('product.review');
Route::delete('/review/{review}', [ProductController::class, 'destroyReview'])->name('review.destroy');



Route::get('/about', function () {
    return view('about');
});

Route::get('/usage_policies', function () {
    return view('usage_policies');
});

require __DIR__ . '/auth.php';
