<?php

use App\Http\Controllers\TestController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [
    TestController::class,
    'getProducts'
]);

Route::get('/products/{id}', [
    TestController::class,
    'getProductById'
]);

Route::post('/products', [
    TestController::class,
    'createProduct'
])->withoutMiddleware([VerifyCsrfToken::class]);

Route::patch('/products/{id}', [
    TestController::class,
    'updateProduct'
])->withoutMiddleware([VerifyCsrfToken::class]);

Route::delete('/products/{id}', [
    TestController::class,
    'deleteProduct'
])->withoutMiddleware([VerifyCsrfToken::class]);


