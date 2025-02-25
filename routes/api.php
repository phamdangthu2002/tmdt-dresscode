<?php

use App\Http\Controllers\api\DanhmucController;
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

Route::post('/add/danh-muc', [DanhmucController::class, 'addDanhmuc']);
Route::get('/load/danh-muc', [DanhmucController::class, 'loadDanhmuc']);
Route::get('/load/parent/danh-muc', [DanhmucController::class, 'loadParent']);
Route::put('/update/danh-muc/{id}', [DanhmucController::class, 'updateDanhmuc']);
Route::delete('/delete/danh-muc/{id}', [DanhmucController::class, 'deleteDanhmuc']);
Route::post('/upload/file', [DanhmucController::class, 'uploadFile']);
