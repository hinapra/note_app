<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RazorpayController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/pay', [RazorpayController::class, 'showPaymentForm']);
Route::post('/payment', [RazorpayController::class, 'handlePayment'])->name('payment');


Route::get('users', [UserController::class, 'showForm'])->name('users.register');
Route::post('users', [UserController::class, 'post'])->name('users.register');