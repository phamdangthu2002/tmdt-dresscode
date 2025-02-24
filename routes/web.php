<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\danhmuc\DanhmucController;
use App\Http\Controllers\admin\sanpham\SanphamController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\HomeController;
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
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::prefix('danh-muc')->group(function () {
        Route::get('/index/danh-muc', [DanhmucController::class, 'index'])->name('admin.danhmuc.index');
    });
    Route::prefix('san-pham')->group(function () {
        Route::get('/index/san-pham', [SanphamController::class, 'index'])->name('admin.sanpham.index');
    });
    Route::prefix('user')->group(function () {
        Route::get('/index/user', [UserController::class, 'index'])->name('admin.user.index');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');