<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('user/{token}',[ProjectController::class, 'user'])->name('project.user');
Route::put('save/{codigo}',[ProjectController::class, 'store'])->name('project.save');
Route::get('show/{codigo}',[ProjectController::class, 'chargeDiagram'])->name('project.show');

