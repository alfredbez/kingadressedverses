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

View::share('authors', App\Author::all());
View::share('topics', App\Topic::all());


Route::get('/', 'SongController@index');
Route::get('song/trash', 'SongController@trash');
Route::get('poem/trash', 'PoemController@trash');
Route::post('song/{id}/restore', 'SongController@restore');
Route::post('search', 'SearchController@run');
Route::resource('file', 'FileController');
Route::resource('song', 'SongController');
Route::resource('poem', 'PoemController');
Route::resource('author', 'AuthorController');
Route::resource('topic', 'TopicController');
Route::resource('composer', 'ComposerController');
Route::resource('category', 'CategoryController');
Route::resource('orchestration', 'OrchestrationController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);