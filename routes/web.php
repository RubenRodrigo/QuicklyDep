<?php

Route::redirect('/', '/posts');
Route::get('/posts', 'PostController@index')->name('posts.search');
Route::get('/posts/create', 'PostController@create');
# Crear Post
Route::post('/posts', 'PostController@store');

# Posts Usuario
Route::get('/posts/myPosts', 'PostController@userPosts');

# Crear Comentario
Route::post('/comments', 'CommentController@store');
# Eliminar Post
Route::delete('/posts/{id}', 'PostController@destroy')->name('post.destroy');

# Filtro de publicaciones
Route::get('/posts/{tipo}/{distrito?}', 'PostController@showPostVentaAlquiler')->name('posts.filtro');

# Editar Post
Route::get('/edit/post/{post_id}', 'PostController@edit')->name('post.edit');
Route::post('/edit/post/', 'PostController@update')->name('update');

# Post Unico
Route::get('/post/{id}', 'PostController@show')->name('post.unico');

# Prueba de Api
Route::get('/prueba/python' ,'CheckController@api')->name('prueba.api');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas de usuarios
Route::patch('/users/{id}', 'UserController@update')->name('users.update');
Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::get('/users/{id}/profile', 'UserController@profile')->name('users.profile');
Route::post('/profile', 'UserController@update_avatar')->name('update.profile');