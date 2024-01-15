<?php

use App\Http\Controllers\QCMController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Models\QCM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    $quizzes = QCM::with(['grades' => function ($query) {
        $query->where('user_id', auth()->id());
    }])
    ->orderBy('created_at', 'desc')
    ->take(4)
    ->get();

    // dd($quizzes[0]->grades[0]->isDone);
    return view('home',compact('quizzes'));
})->name('home');

Route::prefix('/question')->controller(QuestionController::class)->group(function(){

    Route::get('/all','show')->name('questions');
    Route::post('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::put('/update/{id}','update')->name('update');
    Route::delete('/delete/{id}','delete')->name('delete');


    
});


Route::prefix('/qcm')->controller(QCMController::class)->group(function(){
    Route::get('/create-qcm','create')->name('create-qcm');
    Route::post('/store','store')->name('store');
    Route::get('/pass-quiz/{id}','passQuiz')->name('pass-quiz');
    Route::post('/submit-quiz','submitQuiz')->name('submit-quiz');
});



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

    Route::get('/students','showStudents')->name('students');

});