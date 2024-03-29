<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompletedPurchaseController;
use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    if ((Auth::user())) {
        if (!(Auth::user()->type == 'vendedor')) {
            Route::resource('product', ProductController::class)->except('store');
        }
    }

    Route::resource('address', AddressController::class);
    Route::resource('user', ProfileController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');



    Route::post('/mark-review-checked/{reviewId}', [ProductController::class, 'markReviewChecked'])->name('markReviewChecked');

    Route::post('/reviews/{reviewId}/like', [ProductController::class, 'like'])->name('review.like');
    Route::post('/reviews/{reviewId}/dislike', [ProductController::class, 'dislike'])->name('review.dislike');


    // Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    // Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    // Route::resource('answers', AnswerController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('answers', AnswerController::class);
    // Route::post('/answers/{question_id}', [AnswerController::class, 'store'])->name('answers.store');
    

    // Route::get('/gerar-pdf', [PDFController::class, 'gerarPDF']);
    Route::get('/makePDF', [PDFController::class, 'makePDF'])->name('makePDF');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    //reenvia email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

//rotas que o usuario só pode acessar se estiver com o email verificado
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('checkout', CheckoutController::class);


    Route::get('/purchase-success', function () {
        return view('purchase-success');
    })->name('purchase.success');

    Route::GET('/purchase-complete', [CartController::class, 'completePurchase'])->name('purchase.complete');
    Route::get('/deliveries', [DeliverymanController::class, 'index'])->name('deliveries.index');

    Route::post('/checkout', [AddressController::class, 'exibirEnderecos'])->name('address.show');
    Route::post('/checkouts', [CheckoutController::class, 'store'])->name('checkout.store');
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
