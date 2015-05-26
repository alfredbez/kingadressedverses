<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'SongController@index');
Route::get('/trash', 'SongController@trash');
Route::resource('song', 'SongController');
Route::resource('composer', 'ComposerController');
Route::resource('category', 'CategoryController');
Route::resource('orchestration', 'OrchestrationController');