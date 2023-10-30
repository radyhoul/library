<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;

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

Route::get('/', [BookController::class, 'allBook'])->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/product-create', function () {
    return view('product-create');
})->name('product-create');


Route::get('/catalog', [BookController::class, 'catalogBook'])->name('catalog');

Route::get('/search', [BookController::class, 'search'])->name('search');


Route::post('/booking', [BookingController::class, 'booking'])->name('booking-submit');

Route::get('/booking-delete/{id}', [BookingController::class, 'bookingDelete'])->name('booking-delete');

Route::post('/booking-issue/{id}', [BookingController::class, 'bookingIssue'])->name('booking-issue');

Route::post('/booking-take/{id}', [BookingController::class, 'bookingTake'])->name('booking-take');


Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');

Route::post('/profile/{id}', [ProfileController::class, 'personalEdit'])->name('personal-edit');

Route::get('/profile-delete/{id}', [ProfileController::class, 'profileDelete'])->name('profile-delete');

Route::post('/profile-create', [ProfileController::class, 'profileCreate'])->name('profile-create');


Route::get('/product/{id}', [BookController::class, 'book'])->name('product');

Route::get('/product-edit/{id}', [BookController::class, 'bookEdit'])->name('product-edit');

Route::post('/product-edit/{id}', [BookController::class, 'bookEditSubmit'])->name('product-edit-submit');

Route::get('/product-delete/{id}', [BookController::class, 'productDelete'])->name('product-delete');

Route::post('/product-create', [BookController::class, 'productCreate'])->name('product-create');


Route::post('/feedback', [FeedbackController::class, 'feedbackCreate'])->name('feedback-create');

Route::get('/feedback-delete/{id}', [FeedbackController::class, 'feedbackDelete'])->name('feedback-delete');


Auth::routes();
