<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('quan-ly-khach-hang', [HomeController::class, 'quanLyKhachHang']);
