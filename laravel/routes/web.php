<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\BankAccountController;
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

Route::get('/api/v1/bank-accounts', [
    BankAccountController::class,
    'getBankAccounts'
]);

Route::get('/api/v1/bank-accounts/{id}', [
    BankAccountController::class,
    'getBankAccountItem'
]);

Route::post('/api/v1/bank-accounts', [
    BankAccountController::class,
    'createBankAccount'
])->withoutMiddleware([VerifyCsrfToken::class]);

Route::patch('/api/v1/bank-accounts/{id}', [
    BankAccountController::class,
    'updateBankAccount'
])->withoutMiddleware([VerifyCsrfToken::class]);

Route::delete('/api/v1/bank-accounts/{id}', [
    BankAccountController::class,
    'deleteBankAccount'
])->withoutMiddleware([VerifyCsrfToken::class]);

