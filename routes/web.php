<?php

Route::redirect('/', '/posts');
Route::get('/posts', 'PostController@index');
Route::get('/posts/create', 'PostController@create');
Route::post('/posts', 'PostController@store');

# Posts Usuario
Route::get('/posts/myPosts', 'PostController@userPosts');

# Crear Post
Route::post('/comments', 'CommentController@store');
# Eliminar Post
Route::delete('/posts/{id}', 'PostController@destroy');

# Filtro de publicaciones
Route::get('/posts/{tipo}/{pais?}', 'PostController@showPostVentaPais')->name('posts.filtro');

# Editar Post
Route::get('/edit/post/{post_id}', 'PostController@edit')->name('post.edit');
Route::post('/edit/post/', 'PostController@update')->name('post.update');

# Post Unico
Route::get('/post/{id}', 'PostController@show')->name('post.unico');


Auth::routes();

