<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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
Route::get('register',[UserController::class , 'register'])->name('create-user');
Route::post('add-user',[UserController::class , 'addUser'])->name('register');
Route::get('login',[UserController::class , 'login'])->name('login');
Route::post('sign-in',[UserController::class , 'loginUSer'])->name('sign-in');
Route::get('test',[UserController::class , 'test'])->name('test');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
