<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
Route::resource('/admin/portofolio', AdminProjectController::class)->middleware('auth');
Route::get('/admin/portofolio/check_slug/{title}',[AdminProjectController::class,'check_slug']);
Route::get('/',[HomeController::class,'index']);
Route::get('/login',[LoginController::class,'index'])->middleware('guest');
Route::post('/login',[LoginController::class,'auth']);
Route::post('/logout',[LoginController::class,'logout']);
Route::get('/admin',[AdminController::class,'index'])->middleware('auth');
