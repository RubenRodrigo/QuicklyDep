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

Route::redirect('/', '/posts');
Route::get('/posts', 'PostController@index');
Route::get('/posts/create', 'PostController@create');
Route::post('/posts', 'PostController@store');
Route::get('/posts/{id}', 'PostController@show')->name('post');
Route::post('/comments', 'CommentController@store');

Route::get('/post/{tipo}/{pais?}', 'PostController@showPostVentaPais')->name('post.filtro');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de usuarios
Route::patch('/users/{id}', 'UserController@update')->name('users.update');
Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
