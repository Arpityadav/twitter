<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/post', 'PostsController@store');
Route::get('/posts', 'PostsController@index');

Route::get('/{user}', 'UsersController@show')->name('user.show');
Route::get('/{user}/follow', 'UsersController@follow')->name('user.follow');
Route::get('/{user}/unfollow', 'UsersController@unfollow')->name('user.unfollow');