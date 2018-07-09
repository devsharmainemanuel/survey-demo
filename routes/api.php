<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/questions', 'ApiController@get_questions');
Route::post('/survey/submit', 'ApiController@submit_survey');

Route::post('/api/survey/sort', 'SurveyController@sort_questions')->name('question.sort');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
