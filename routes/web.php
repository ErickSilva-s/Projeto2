<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
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
    Route::resource('checkout', CheckoutController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');

    Route::get('/purchase-success', function () {
        return view('purchase-success');
    })->name('purchase.success');
    Route::post('/purchase-complete', [CartController::class, 'completePurchase'])->name('purchase.complete');

    Route::post('/mark-review-checked/{reviewId}', [ProductController::class, 'markReviewChecked'])->name('markReviewChecked');

    Route::post('/checkout', [AddressController::class, 'exibirEnderecos'])->name('address.show');
    Route::post('/checkouts', [CheckoutController::class, 'store'])->name('checkout.store');


    Route::post('/reviews/{reviewId}/like', [ProductController::class, 'like'])->name('review.like');
    Route::post('/reviews/{reviewId}/dislike', [ProductController::class, 'dislike'])->name('review.dislike');

    Route::get('/deliveries', [DeliverymanController::class, 'index'])->name('deliveries.index');

    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    Route::post('/questions/{question}/answer', [QuestionController::class, 'answer'])->name('questions.answer');

    // Route::get('/gerar-pdf', [PDFController::class, 'gerarPDF']);
    Route::get('/makePDF', [PDFController::class, 'makePDF'])->name('makePDF');
});


// rotas que os users podem acessar mesmo não estando logado
Route::resource('product', ProductController::class);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/review', [ProductController::class, 'submitReview'])->name('product.review');
Route::delete('/review/{review}', [ProductController::class, 'destroyReview'])->name('review.destroy');



Route::get('/about', function () {
    return view('about');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/usage_policies', function () {
    return view('usage_policies');
});

require __DIR__ . '/auth.php';
