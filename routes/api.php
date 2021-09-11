<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

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


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [Logincontroller::class, 'logout']);
    Route::post('refresh', [Logincontroller::class, 'refresh']);
    Route::post('me', [Logincontroller::class, 'me'])->middleware(['jwt.role:admin'])->name('me');
});
