<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/user/add', [UserController::class, 'addUser']);
Route::middleware('auth:sanctum')->put('/user/update/{uuid}', [UserController::class, 'modifyUser'], ["uuid"]);
Route::middleware('auth:sanctum')->delete('/user/delete', [UserController::class, 'deleteUser']);