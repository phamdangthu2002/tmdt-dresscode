<?php

use App\Http\Controllers\api\ApiDanhmucController;
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

Route::post('/add/danh-muc', [ApiDanhmucController::class, 'addDanhmuc']);
Route::get('/load/danh-muc', [ApiDanhmucController::class, 'loadDanhmuc']);
Route::get('/load/parent/danh-muc', [ApiDanhmucController::class, 'loadParent']);
Route::put('/update/danh-muc/{id}', [ApiDanhmucController::class, 'updateDanhmuc']);
Route::delete('/delete/danh-muc/{id}', [ApiDanhmucController::class, 'deleteDanhmuc']);

Route::post('/add/user', [ApiUserController::class, 'addUser']);
Route::get('/load/user', [ApiUserController::class, 'loadUser']);
Route::put('/update/user/{id}', [ApiUserController::class, 'updateUser']);
Route::delete('/delete/user/{id}', [ApiUserController::class, 'deleteUser']);

