<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\GalleryController;

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
Route::get('register',[UserController::class , 'register'])->name('create-user');
Route::post('add-user',[UserController::class , 'addUser'])->name('register');
Route::get('login',[UserController::class , 'login'])->name('login');
Route::post('sign-in',[UserController::class , 'loginUSer'])->name('sign-in');


Route::middleware(['auth'])->group(function () {
    Route::get('logout',[UserController::class , 'logout']);
    Route::get('gallery',[GalleryController::class , 'index']);
    Route::post('add-url',[WebsiteController::class , 'addUrl'])->name('add-url');
    Route::post('upload-images',[GalleryController::class,'upload'])->name('upload');
    Route::get('reorder',[GalleryController::class,'reorder'])->name('reorder');
    // Route::get('count-clicks',[WebsiteController::class , 'countClick'])->name('count-clicks');
       
});

Route::get('/', function () {
    return redirect()->to('gallery');
});
