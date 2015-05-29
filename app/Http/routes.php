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

View::share('categories', App\Category::all());
View::share('composers', App\Composer::all());
View::share('orchestrations', App\Orchestration::all());


Route::get('/', 'SongController@index');
Route::get('trash', 'SongController@trash');
Route::post('song/{id}/restore', 'SongController@restore');
Route::resource('file', 'FileController');
Route::resource('song', 'SongController');
Route::resource('composer', 'ComposerController');
Route::resource('category', 'CategoryController');
Route::resource('orchestration', 'OrchestrationController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);