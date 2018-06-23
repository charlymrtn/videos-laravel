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

Route::post('/comment',['as' => 'comment','middleware' => 'auth', 'uses' => 'CommentController@store']);
Route::get('/delete-comment/{id}',['as' => 'delete-comment','middleware' => 'auth', 'uses' => 'CommentController@delete']);
Route::get('/delete-video/{id}',['as' => 'delete-video','middleware' => 'auth', 'uses' => 'VideoController@delete']);

Route::get('/edit-video/{id}',['as' => 'edit-video','middleware' => 'auth', 'uses' => 'VideoController@edit']);
Route::post('/update-video/{id}',['as' => 'update-video','middleware' => 'auth', 'uses' => 'VideoController@update']);

Route::get('/search/{search?}/{filter?}',['as' => 'search-video','uses' => 'VideoController@search']);


Route::get('clear-cache', function(){
  $code = Artisan::call('cache:clear');
});

Route::get('canal/{id}',['as' => 'channel','uses' => 'UserController@channel']);
