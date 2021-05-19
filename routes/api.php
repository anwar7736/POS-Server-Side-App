<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//User
Route::post('/AddUser',[UserController::class,'AddUser']);
Route::get('/DeleteUser/{id}',[UserController::class,'DeleteUser']);
Route::get('/SelectUser',[UserController::class,'SelectUser']);
Route::post('/UpdateUser',[UserController::class,'UpdateUser']);


//Category

Route::post('/AddCategory',[CategoryController::class,'AddCategory']);
Route::get('/SelectCategory',[CategoryController::class,'SelectCategory']);
Route::get('/DeleteCategory/{id}',[CategoryController::class,'DeleteCategory']);
Route::post('/UpdateCategory',[CategoryController::class,'UpdateCategory']);


//Product
Route::post('/AddProduct',[ProductController::class,'AddProduct']);
Route::get('/SelectProduct',[ProductController::class,'SelectProduct']);
Route::get('/DeleteProduct/{id}',[ProductController::class,'DeleteProduct']);
Route::post('/UpdateProductWithImage',[ProductController::class,'UpdateProductWithImage']);
Route::post('/UpdateProductWithoutImage',[ProductController::class,'UpdateProductWithoutImage']);
Route::get('/SelectProductByCategory/{Category}',[ProductController::class,'SelectProductByCategory']);


// Dashboard
Route::get('/CountProduct',[DashboardController::class,'CountProduct']);
Route::get('/CountCategory',[DashboardController::class,'CountCategory']);
Route::get('/CountTransaction',[DashboardController::class,'CountTransaction']);
Route::get('/CountTotalIncome',[DashboardController::class,'CountTotalIncome']);
Route::get('/RecentTransactionList',[DashboardController::class,'RecentTransactionList']);
Route::get('/IncomeLast7Days',[DashboardController::class,'IncomeLast7Days']);



// Cart
Route::post('/CartAdd',[CartController::class,'CartAdd']);
Route::get('/CartItemPlus/{id}/{quantity}/{price}',[CartController::class,'CartItemPlus']);
Route::get('/CartItemMinus/{id}/{quantity}/{price}',[CartController::class,'CartItemMinus']);
Route::get('/RemoveCartList/{id}',[CartController::class,'RemoveCartList']);
Route::get('/CartList',[CartController::class,'CartList']);


// Transaction
Route::get('/CartSell/{invoice}',[TransactionController::class,'CartSell']);


//Report
Route::get('/TransactionList',[ReportController::class,'TransactionList']);
Route::get('/TransactionListByDate',[ReportController::class,'TransactionListByDate']);




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
