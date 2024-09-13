<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LoyaltyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigController;

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
Route::get('/home', function () {
    return view('welcome');
})->name('home');


// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::get('/logout', [AuthController::class, 'logout']);

// Xử lý đăng ký
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::group(['prefix'=>'category'],function(){
    Route::get('/add',[CategoryController::class,'add']);
    Route::post('/add',[CategoryController::class,'store'])->name('category.store');
});

Route::group(['prefix' => 'product', 'middleware' => ['role:admin|agency']], function() {

    Route::get('/add', [ProductController::class, 'add'])->name('products.add');
    Route::post('/add', [ProductController::class, 'store'])->name('products.store');
});
Route::group(['prefix' => 'coupon', 'middleware' => ['role:admin|agency']], function() {
    Route::get('/add',[CouponController::class,'add']);
    Route::post('/add', [CouponController::class, 'store'])->name('coupon.add');
});
Route::middleware('role:user')->group(function() {
    Route::prefix('cart')->group(function() {
        Route::get('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/add', [CartController::class, 'store'])->name('cart.store');
    });
});
Route::group(['prefix' => 'product', 'middleware' => ['role:admin|agency']], function() {
    Route::get('/add', [ProductController::class, 'add'])->name('products.add');
    Route::post('/add', [ProductController::class, 'store'])->name('products.store');
});
Route::middleware('role:user')->get('/coupon/apply/{cartId}',[OrderController::class,'showOrder'])->name('coupon.apply');
Route::middleware('role:user')->post('/coupon/apply/{cartId}',[OrderController::class,'applyCoupon'])->name('cart.applyCoupon');
Route::get('/coupon',[CouponController::class,'index'])->name('coupon.index');

Route::get('/loyalty/set', [ConfigController::class, 'getLoyalty'])->name('config.loyalty');
Route::post('/loyalty/set', [ConfigController::class, 'settingLoyalty'])->name('config.loyalty.set');
Route::get('/loyalty/earn/{orderId}', [LoyaltyController::class, 'earnPointsFromOrder'])->name('loyalty.earn');
Route::get('/loyalty/membership/update/{userId}', [LoyaltyController::class, 'updateMembership'])->name('loyalty.membership.update');
