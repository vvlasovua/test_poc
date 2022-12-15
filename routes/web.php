<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialiteController;
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
    return view('welcome');
});

Route::get("login-register", [SocialiteController::class, 'loginRegister']);
Route::get("redirect/{provider}", [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get("callback/{provider}", [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
