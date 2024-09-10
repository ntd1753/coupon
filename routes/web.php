<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
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
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('role:admin')->get('/coupon/add',[CouponController::class,'add']);
//Route::middleware('role:user')->get('/coupon/apply/{cartId}',[OrderController::class,'showOrder']);
Route::middleware('role:user')->get('/coupon/apply/{cartId}',[OrderController::class,'applyCoupon']);
// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::get('/logout', [AuthController::class, 'logout']);

// Xử lý đăng ký
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/coupon/add', [CouponController::class, 'store'])->name('coupon.add');
