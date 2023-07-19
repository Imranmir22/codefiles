<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('register',[UserController::class , 'register']);
Route::post('add-user',[UserController::class , 'addUser']);
Route::get('login',[UserController::class , 'login'])->name('login');
Route::post('sign-in',[UserController::class , 'loginUSer']);
Route::get('count-words',[UserController::class , 'countWords']);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[UserController::class , 'dashboard']);
    Route::get('logout',[UserController::class , 'logout']);
   
});

Route::get('/', function () {
    return view('auth.login');
});
