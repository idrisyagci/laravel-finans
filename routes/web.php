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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace'=>'front', 'middleware'=>'auth'], function (){
    Route::group(['namespace'=>'home', 'as'=>'home.'], function (){
        Route::get('/', 'indexController@index')->name('index');
    });

    Route::group(['namespace'=>'musteriler', 'as'=>'musteriler.', 'prefix'=>'musteriler'], function (){
        Route::get('/', 'indexController@index')->name('index');
        Route::get('/olustur', 'indexController@create')->name('create');
        Route::post('/olustur', 'indexController@store')->name('store');
        Route::get('/duzenle/{id}', 'indexController@edit')->name('edit');
        Route::post('/duzenle/{id}', 'indexController@update')->name('update');
        Route::get('/delete/{id}', 'indexController@delete')->name('delete');
        Route::post('/data', 'indexController@data')->name('data');
    });

    Route::group(['namespace'=>'kalem', 'as'=>'kalem.', 'prefix'=>'kalem'], function (){
        Route::get('/', 'indexController@index')->name('index');
        Route::get('/olustur', 'indexController@create')->name('create');
        Route::post('/olustur', 'indexController@store')->name('store');
        Route::get('/duzenle/{id}', 'indexController@edit')->name('edit');
        Route::post('/duzenle/{id}', 'indexController@update')->name('update');
        Route::get('/delete/{id}', 'indexController@delete')->name('delete');
        Route::post('/data', 'indexController@data')->name('data');
    });

    Route::group(['namespace'=>'fatura', 'as'=>'fatura.', 'prefix'=>'fatura'], function (){
        Route::get('/', 'indexController@index')->name('index');
        Route::get('/olustur/{type}', 'indexController@create')->name('create');
        Route::post('/olustur/{type}', 'indexController@store')->name('store');
        Route::get('/duzenle/{id}', 'indexController@edit')->name('edit');
        Route::post('/duzenle/{id}', 'indexController@update')->name('update');
        Route::get('/delete/{id}', 'indexController@delete')->name('delete');
        Route::post('/data', 'indexController@data')->name('data');
    });
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
