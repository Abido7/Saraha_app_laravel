<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('/saraha', function () {
    return view('home');
});
Route::get('/user/{id}', [UserController::class, 'index']); //public 

Route::get("/profile/{id}", [UserController::class, 'details'])->middleware('is_private');


Route::get('/messageForm/{id}', [MessageController::class, 'index']); //public
Route::post('/message', [MessageController::class, 'sendMessage']); //public

Route::get('/user/{uId}/delete/{msgId}', [MessageController::class, 'delete'])->middleware('owen_message');


Route::get('/register', [AuthController::class, 'index'])->middleware('guest'); //guest
Route::post('/register', [AuthController::class, 'register'])->middleware('guest'); //guest
Route::get('/login', [AuthController::class, 'loginForm'])->middleware('guest'); //guest
Route::post('/login', [AuthController::class, 'login'])->middleware('guest'); //guest

Route::get('/profile/edit/{id}', [AuthController::class, 'edit'])->middleware('is_private'); //private 
Route::post('/profile/update/{id}', [AuthController::class, 'update'])->middleware('is_private'); //private 
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');