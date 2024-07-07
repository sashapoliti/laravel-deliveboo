<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\PlateController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\PaymentController;



use Illuminate\Support\Facades\Route;
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'processPayment']);



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

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug'])->except('show', 'edit', 'update');
    Route::resource('plates', PlateController::class)->parameters(['plates' => 'plate:slug'])->except('show');
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
    Route::resource('orders', OrderController::class)->parameters(['orders' => 'order:id'])->only(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::fallback(function () {
    return redirect()->route('admin.dashboard');
});
