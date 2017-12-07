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


Auth::routes();

Route::get('/', 'UrlsController@home')->name('index');

Route::get('/*', 'UrlsController@redirect')->name('redirect');

Route::middleware('auth')->group(function () {

    Route::get('/urls', 'UrlsController@index')->name('home');
    Route::get('/urls/create', 'UrlsController@create')->name('create');
    Route::post('/urls/create', 'UrlsController@store')->name('create');
    Route::get('/urls/{id}/delete', 'UrlsController@delete')->name('delete');
    Route::get('/urls/{id}/share', 'UrlsController@share')->name('share');

});
