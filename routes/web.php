<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ErrorExplainer;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/users', [UserController::class,'create'])->name('CreateUser');
Route::post('/users', [UserController::class,'store'])->name('CreateUsers');

Route::get('/userdetails', [UserController::class,'show'])->name('UserDetails');
Route::get('/update/{id}',[UserController::class,'edit'])->name('updateUser');
Route::post('/update/{id}',[UserController::class,'update'])->name('updateUser');
Route::get('/deleteUser/{id}',[UserController::class,'destroy'])->name('deleteUser');

Route::get('/login', [UserController::class,'loginShow'])->name('loginShow');
Route::post('/login', [UserController::class,'login'])->name('login');
Route ::get('/logout',[UserController::class,'logout'])->name('logout');

Route::get('/errorExplainer', [ErrorExplainer::class,'index'])->name('errorExplainer');
Route::post('/errorExplainer', [ErrorExplainer::class,'errorFinder'])->middleware('auth');


Route::get('/admin',[AdminController::class,'index'])->name('Admin')->middleware('admin');;
Route::get('/adminSignUp',[AdminController::class,'create'])->name('AdminSignUp');
Route::post('/adminSignUp',[AdminController::class,'store'])->name('AdminSignUp');
//Adminlogout
Route::get('/adminlogout',[AdminController::class,'logout'])->name('Adminlogout');

Route::get('/adminLogin',[AdminController::class,'loginShow'])->name('AdminLogin');
Route::post('/adminLogin',[AdminController::class,'login'])->name('AdminLogin');

Route::get('/result', function () {
    return view('users.result');
})->name('result');