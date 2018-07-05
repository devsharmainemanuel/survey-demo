<?php

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

Route::get('/', function () { return view('home'); });

Auth::routes();

/*user routes */
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/submit', 'HomeController@store_survey');     
/*end user routes */


/*admin routes*/

//login
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

//crud
Route::get('/survey', 'SurveyController@index')->name('admin.dashboard');
Route::get('/survey/results', 'SurveyController@view_results')->name('results');
Route::get('/survey/archives', 'SurveyController@view_archives')->name('archives');
Route::get('/survey/new', 'SurveyController@new_question');
Route::post('/survey/save', 'SurveyController@store_question');
Route::post('/survey/update', 'SurveyController@update_question');
Route::get('/survey/{id}/edit', 'SurveyController@edit_question');
Route::get('/survey/{id}/delete', 'SurveyController@delete_question');
Route::get('/survey/{id}/retrieve', 'SurveyController@retrieve_question');


Route::get('/result/{id}', 'SurveyController@user_result')->name('user.result');
/*end admin routes*/