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

Route::get('/', function () {
    return redirect('home');;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/crear-video',['as' => 'crear-video','middleware' => 'auth', 'uses' => 'VideoController@create']);

Route::post('/save-video',['as' => 'save-video','middleware' => 'auth', 'uses' => 'VideoController@store']);

Route::get('/miniatura/{filename}',['as' => 'image-video', 'uses' => 'VideoController@image']);
Route::get('/file/{filename}',['as' => 'file-video', 'uses' => 'VideoController@video']);

Route::get('/video/{id}',['as' => 'video-detail', 'uses' => 'VideoController@show']);
