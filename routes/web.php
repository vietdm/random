<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('quan-ly-khach-hang', [HomeController::class, 'quanLyKhachHang']);

Route::prefix('admin')->name('admin.')->group(function() {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'admin.php';
});
