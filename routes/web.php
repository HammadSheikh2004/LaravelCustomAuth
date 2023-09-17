<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/register', [UserController::class, 'register'])->name("register");
Route::post('/auth/register', [UserController::class, 'saveData'])->name("SaveData");
Route::get('/auth/login', [UserController::class, 'login'])->name("login");
Route::post('/auth/login', [UserController::class, 'loginData'])->name("LoginData");

Route::group(['middleware' => ['LoginCheck']], function () {
    Route::get('/', [UserController::class, 'welcome'])->name("Welcome");
    Route::get('/layout/profile', [UserController::class, 'profile'])->name("profile");
    Route::get('/logout', [UserController::class, 'logoutData'])->name("LogoutData");
    Route::post('/profileImage', [UserController::class, 'UserImage'])->name("ProfileImage");
});
