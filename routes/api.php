<?php

use App\Http\Controllers\admin\size_color\MixController;
use App\Http\Controllers\api\ApiCartController;
use App\Http\Controllers\api\ApiDanhmucController;
use App\Http\Controllers\api\ApiSanphamController;
use App\Http\Controllers\api\ApiUserController;
use App\Http\Controllers\auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload/file', [ApiDanhmucController::class, 'uploadFile']);
Route::post('/upload/files', [ApiDanhmucController::class, 'uploadMultipleFiles']);

Route::post('/add/danh-muc', [ApiDanhmucController::class, 'addDanhmuc']);
Route::get('/load/danh-muc', [ApiDanhmucController::class, 'loadDanhmuc']);
Route::get('/load/danh-muc-home', [ApiDanhmucController::class, 'loadDanhmucHome']);
Route::get('/load/parent/danh-muc', [ApiDanhmucController::class, 'loadParent']);
Route::put('/update/danh-muc/{id}', [ApiDanhmucController::class, 'updateDanhmuc']);
Route::delete('/delete/danh-muc/{id}', [ApiDanhmucController::class, 'deleteDanhmuc']);

Route::post('/add/user', [ApiUserController::class, 'addUser']);
Route::get('/load/user', [ApiUserController::class, 'loadUser']);
Route::put('/update/user/{id}', [ApiUserController::class, 'updateUser']);
Route::delete('/delete/user/{id}', [ApiUserController::class, 'deleteUser']);

Route::get('/size/{id}', [MixController::class, 'getSizeID'])->name('getSizeID');
Route::get('/load/size', [MixController::class, 'loadSize']);
Route::get('/color/{id}', [MixController::class, 'getColorID'])->name('getColorID');
Route::get('/load/color', [MixController::class, 'loadColor']);

Route::post('/add/san-pham', [ApiSanphamController::class, 'addSanpham'])->name('addSanpham');
Route::get('/load/san-pham', [ApiSanphamController::class, 'loadSanpham'])->name('loadSanpham');
Route::get('/load/san-pham/{id}', [ApiSanphamController::class, 'loadSanphamID'])->name('loadSanphamID');
Route::get('/load/san-pham-home', [ApiSanphamController::class, 'loadSanphamHome'])->name('loadSanphamHome');
Route::get('/load/san-pham-danhmuc/{id}', [ApiSanphamController::class, 'loadSanphamDanhmuc'])->name('loadSanphamDanhmuc');
Route::get('/load/san-pham-random', [ApiSanphamController::class, 'loadSanphamRandom'])->name('loadSanphamRandom');
Route::get('/load/san-pham/danh-muc/{id}', [ApiSanphamController::class, 'loadSanphamDanhmucID']);
Route::get('/load/san-pham/search/{keyword}', [ApiSanphamController::class, 'loadSanphamSearch'])->name('loadSanphamSearch');
Route::put('/update/san-pham/{id}', [ApiSanphamController::class, 'updateSanpham'])->name('updateSanpham');
Route::delete('/delete/san-pham/{id}', [ApiSanphamController::class, 'deleteSanpham'])->name('deleteSanpham');

Route::post('/add/cart', [ApiCartController::class, 'addTocart']);
Route::get('/load/gio-hang/{id}', [ApiCartController::class, 'getGiohang']);
Route::get('/count-cart/{id}', [ApiCartController::class, 'countCart']);