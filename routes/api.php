<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Plan\PlanController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiTransactionController;
use App\Http\Controllers\Subscription\SubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');

	Route::group(['prefix' => '/Cards', 'controller' => \App\Http\Controllers\Cards\CreditCardController::class], function(){
		// Rutas de los usuarios
		Route::get('/', 'index')->name('cardsIndex');
		Route::post('/save', 'save')->name('cardsSave');
	});
});

Route::post('auth/token', [ApiAuthController::class, 'login']);
Route::middleware(['apiauth', 'auth:sanctum'])->group(function(){
	Route::group(['prefix'=>'Payments', 'controller' => ApiTransactionController::class], function(){
		Route::group(['prefix' => 'CreateTransaction'],function(){
			Route::post('Charge', 'createTransactionCharge');
			Route::post('Receive', 'createTransactionReceive');
			Route::post('Send', 'createTransactionSend');
		});
	});
});
