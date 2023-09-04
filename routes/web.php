<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gateways\MollieController;
use App\Http\Controllers\Gateways\PaypalController;
use App\Http\Controllers\Gateways\StripeController;
use App\Http\Controllers\Gateways\PaystackController;
use App\Http\Controllers\Gateways\RazorpayController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Gateways\InstamojoController;
use App\Http\Controllers\Gateways\TwoCheckoutController;

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
// Paypal Routes
Route::post('paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');

// Stripe Routes
Route::post('stripe/payment', [StripeController::class, 'payment'])->name('stripe.payment');
Route::get('stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

// Razorpay Routes
Route::post('razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');

// 2Checkout Routes
Route::get('twocheckout/payment',[TwoCheckoutController::class, 'showFrom'])->name('twocheckout.payment');
Route::post('twocheckout/handle-payment',[TwoCheckoutController::class, 'handlePayment'])->name('twocheckout.handle-payment');
Route::get('twocheckout/success', [TwoCheckoutController::class, 'success'])->name('twocheckout.success');
// Route::get('twocheckout/cancel', [TwoCheckoutController::class, 'cancel'])->name('twocheckout.cancel');

// Instamojo Routes
Route::post('instamojo/payment', [InstamojoController::class, 'payment'])->name('instamojo.payment');
Route::get('instamojo/callback', [InstamojoController::class, 'callback'])->name('instamojo.callback');

// Mollie Routes
Route::post('mollie/payment', [MollieController::class, 'payment'])->name('mollie.payment');
Route::get('mollie/success', [MollieController::class, 'success'])->name('mollie.success');

// Paystack Routes
Route::get('paystack/redirect', [PaystackController::class, 'paystackRedirect'])->name('paystack.redirect');
Route::get('paystack/callback', [PaystackController::class, 'verifyTransaction'])->name('paystack.callback');

// SSLCOMMERZ Start

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslcommerz.pay');

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

//SSLCOMMERZ END
