<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\SurveyController;
use App\Http\Controllers\API\SurveyController;


//Route::get('/random-question', [SurveyController::class, 'getRandomQuestion']);

//Route::get('/random-question', 'API\SurveyController@getRandomQuestion');
Route::get('/random-question', [SurveyController::class, 'getRandomQuestion']);

Route::get('/test', function () {
    return response()->json(['message' => 'Test successful']);
});