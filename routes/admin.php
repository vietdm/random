<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')->group(function() {
    Route::get('/', [HomeController::class, 'home']);
    Route::post('/logout', function() {
        auth()->logout();
        return redirect('admin/login');
    });

    Route::prefix('customer')->group(function() {
        Route::get('', [CustomerController::class, 'list']);
        Route::post('/add', [CustomerController::class, 'add']);
        Route::post('/edit/{id}', [CustomerController::class, 'edit']);
        Route::post('/delete/{id}', [CustomerController::class, 'delete']);
        Route::post('/truncate', [CustomerController::class, 'truncate']);
        Route::get('/{type}/{value}', [CustomerController::class, 'getOne']);
    });
});

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginConfirmation'])->name('login.post');
