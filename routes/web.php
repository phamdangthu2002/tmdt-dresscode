<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\danhmuc\DanhmucController;
use App\Http\Controllers\admin\sanpham\SanphamController;
use App\Http\Controllers\admin\size_color\MixController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\user\HomeController;
use App\Http\Middleware\VerifyRecaptcha;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


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

Route::get('/auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/auth/facebook/callback', function () {
    $facebookUser = Socialite::driver('facebook')->user();
    $user = User::updateOrCreate([
        'email' => $facebookUser->getEmail(),
    ], [
        'name' => $facebookUser->getName(),
        'facebook_id' => $facebookUser->getId(),
        'avatar' => $facebookUser->getAvatar(),
    ]);

    Auth::login($user);
    return redirect('/dashboard');
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::prefix('admin')->middleware('auth')->group(function () {
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
    Route::prefix('size')->group(function () {
        Route::get('/index/size', [MixController::class, 'indexSize'])->name('admin.size.index');
        Route::post('/add/size', [MixController::class, 'addSize'])->name('admin.size.add');
        Route::post('/update/{id}', [MixController::class, 'updateSize'])->name('admin.size.update');
        Route::get('/delete/{id}', [MixController::class, 'deleteSize'])->name('admin.size.delete');
    });
    Route::prefix('color')->group(function () {
        Route::get('/index/color', [MixController::class, 'indexColor'])->name('admin.color.index');
        Route::post('/add/color', [MixController::class, 'addColor'])->name('admin.color.add');
        Route::post('/update/{id}', [MixController::class, 'updateColor'])->name('admin.color.update');
        Route::get('/delete/{id}',[MixController::class,'deleteColor'])->name('admin.color.delete');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');