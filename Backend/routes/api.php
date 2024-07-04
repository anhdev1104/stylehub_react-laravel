<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\CategoryController;
use App\Http\Controllers\Apis\ProductController;
use App\Http\Controllers\Apis\SubcategoryController;
use App\Http\Controllers\Apis\ImageController;
use App\Http\Controllers\Apis\SizeController;
use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\UserController;
use App\Http\Controllers\Apis\BrandController;
use App\Http\Controllers\Apis\OrderController;
use App\Http\Controllers\Apis\OrderDetailController;
use App\Http\Controllers\Apis\StatiscalController;

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

Route::prefix('v1')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'getById']) ;
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

    Route::get('/subcategories', [SubcategoryController::class, 'index']);
    Route::get('/categories/{categoryId}/subcategories', [SubcategoryController::class, 'getSubcategoriesByCategory']);
    Route::post('/subcategories', [SubcategoryController::class, 'store']);
    Route::put('/subcategories/{id}', [SubcategoryController::class, 'update']);
    Route::delete('/subcategories/{id}', [SubcategoryController::class, 'delete']);
    Route::get('/subcategories/{id}', [SubcategoryController::class, 'getById']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);
    Route::get('/products/{id}', [ProductController::class, 'getById']);
    Route::get('/new-products', [ProductController::class, 'newProducts']);
    Route::get('/random-products', [ProductController::class, 'randomProducts']);
    Route::get('/popular-products', [ProductController::class, 'popularProducts']);
    Route::get('/seller-products', [ProductController::class, 'sellerProducts']);
    Route::get('/categories/{categoryId}/products', [ProductController::class, 'getProductsByCategory']);
    Route::get('/subcategories/{subcatId}/products', [ProductController::class, 'getProductsBySubcategory']);

    Route::get('/images', [ImageController::class, 'index']);
    Route::get('/images/{id}', [ImageController::class, 'getById']);
    Route::post('/images', [ImageController::class, 'store']);
    Route::put('/images/{id}', [ImageController::class, 'update']);
    Route::delete('/images/{id}', [ImageController::class, 'delete']);
    Route::get('/products/{productId}/images', [ImageController::class, 'getByProductId']);
    
    Route::post('/sizes', [SizeController::class, 'store']);
    Route::get('/products/{productId}/sizes', [SizeController::class, 'index']);

    Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::get('/refresh-token', [AuthController::class, 'refresh'])->middleware('jwt.auth');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest');

    Route::get('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');

    Route::get('/users', [UserController::class, 'index']);
    Route::put('/profile/{id}', [UserController::class, 'updateProfile'])->middleware('jwt.auth');

    Route::get('/brands', [BrandController::class, 'index']);

    Route::get('/orders', [OrderController::class, 'index'])->middleware('jwt.auth');
    Route::get('/orders/{id}', [OrderController::class, 'orderById'])->middleware('jwt.auth');
    Route::post('/orders', [OrderController::class, 'store'])->middleware('jwt.auth');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->middleware('jwt.auth');

    
    Route::get('/order-details', [OrderDetailController::class, 'index'])->middleware('jwt.auth');
    Route::get('/orders/{id}/order-details', [OrderDetailController::class, 'getOrderId'])->middleware('jwt.auth');

    Route::get('/order-statistical', [StatiscalController::class, 'orderStatistical']);
    Route::get('/order-count', [StatiscalController::class, 'countOrder']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});