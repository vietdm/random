<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WinnerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('quan-ly-khach-hang', [HomeController::class, 'quanLyKhachHang']);

Route::prefix('customer')->group(function() {
    Route::get('', [CustomerController::class, 'list']);
});

Route::prefix('winner')->group(function() {
    Route::get('', [WinnerController::class, 'list']);
    Route::post('truncate', [WinnerController::class, 'truncate']);
    Route::post('{code}', [WinnerController::class, 'add']);
});

Route::prefix('admin')->name('admin.')->group(function() {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'admin.php';
});
