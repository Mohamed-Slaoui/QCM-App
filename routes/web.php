<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    return view('home');
})->name('home');

Route::prefix('/question')->controller(QuestionController::class)->group(function(){

    Route::get('/all','show')->name('questions');
    Route::post('/create','create')->name('create');
    Route::put('/edit/{id}','edit')->name('edit');
    // Route::put('/delete/{id}','delete')->name('delete');


    
});


Route::get('/qcm',function(){ return view('qcm');})->name('qcm');
// -----------Authentification---------------
Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/register', function(){
    return view('register');
})->name('register');

Route::prefix('/')->controller(UserController::class)->group(function(){

    Route::post('addUser','addUser')->name('addUser');
    
    Route::post('logUser', 'logUser')->name('logUser');
    
    Route::get('logout','logout')->name('logout');
});