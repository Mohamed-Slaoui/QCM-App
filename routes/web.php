<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    return view('home');
})->name('home');

Route::get('/questions',function(){
    return view('questions');
})->name('questions');

Route::get('/qcm',function(){
    return view('qcm');
})->name('qcm');


Route::get('/login', function(){
    return view('login');
})->name('loginForm');

Route::get('/register', function(){
    return view('register');
})->name('registerForm');

Route::get('/logout',[UserController::class, 'logout'])->name('logout');