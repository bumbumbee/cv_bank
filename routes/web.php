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

Route::get('/', 'PostsController@index');
Route::get('/upload', 'PostsController@create');
Route::get('/{id}', 'PostsController@show');
Route::post('/', 'PostsController@store');
Route::get('/{id}/edit', 'PostsController@edit');
Route::put('/{id}', 'PostsController@update');
Route::delete('/{id}', 'PostsController@destroy');

//Route::resource('posts', 'PostsController');  // dabar netinka

