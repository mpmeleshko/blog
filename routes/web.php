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

Route::get('/', 'ArticlesController@index')->name('home');

Route::post('articles', 'ArticlesController@store');

Route::get('articles/create', 'ArticlesController@create');

Route::get('article/{id}', ['as' => 'article_id', 'uses' => 'ArticlesController@show']);


Route::get('article/edit/{id}', 'ArticlesController@edit');

Route::post('article/edit/{id}', 'ArticlesController@update');


Route::get('article/delete/{id}', 'ArticlesController@delete');


Route::get('registration', 'RegistrationController@create');

Route::post('registration', 'RegistrationController@store');


Route::get('login', 'SessionsController@create');

Route::post('login', 'SessionsController@store');

Route::get('logout', 'SessionsController@destroy');