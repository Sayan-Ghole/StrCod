<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ErrorExplainer;

Route::get('/', function () {
    return view('home');
});
Route::get('/users', [userController::class,'create'])->name('CreateUser');
Route::post('/users', [userController::class,'store']);

Route::get('/userdetails', [userController::class,'show'])->name('UserDetails');
Route::get('/update/{id}',[userController::class,'edit'])->name('updateUser');
Route::post('/update/{id}',[userController::class,'update'])->name('updateUser');
Route::get('/deleteUser/{id}',[userController::class,'destroy'])->name('deleteUser');

Route::get('/login', [userController::class,'loginShow'])->name('loginShow');
Route::post('/login', [userController::class,'login'])->name('login');
Route ::get('/logout',[userController::class,'logout'])->name('logout');

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