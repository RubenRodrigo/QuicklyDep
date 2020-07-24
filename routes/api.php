<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Ruta API para los posts
Route::get('posts', 'PostController@indexAPI');
Route::get('post/{id}', 'PostController@showPostAPI');
// Ruta API para los usuarios
Route::get('user/{email}', 'UserController@tipoUser');