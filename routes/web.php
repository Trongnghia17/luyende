<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/submit',[MainController::class,'UserRegisterHPN'])->name('submit');
Route::post('/submit2',[MainController::class,'UserRegisterHPN2'])->name('submit2');

Route::get('/admin',[MainController::class,'admin'])->name('admin');
Route::get('/admin_login',[MainController::class,'admin_login'])->name('admin_login');
Route::post('/check_login',[MainController::class,'check_login'])->name('check_login');
