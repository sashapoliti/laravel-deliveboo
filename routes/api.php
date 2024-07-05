<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\API\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('restaurants', [RestaurantController::class, 'index']);
Route::get('restaurants/{slug}', [RestaurantController::class, 'show']);
Route::get('types', [TypeController::class, 'index']);
Route::get('/payment/token', [PaymentController::class, 'getToken']);
Route::post('/payment/process', [PaymentController::class, 'processPayment']);

Route::post('/order', [OrderController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
