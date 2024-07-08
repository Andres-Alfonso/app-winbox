<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/random-question', [SurveyController::class, 'getRandomQuestion']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/public', [SurveyController::class,'index']);

Route::post('/public', [SurveyController::class,'saveAnswer'])->name('entries.saveAnswer');


Route::view('/success/survey', 'survey.message')->name('survey.success');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::view('/survey/create', 'survey.new')->name('survey.new');
    Route::post('/save/survey', [SurveyController::class,'store'])->name('entries.saveSurvey');
});


Route::middleware('guest')->group(function () {
});

require __DIR__.'/auth.php';
