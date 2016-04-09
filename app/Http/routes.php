<?php

Route::get('/','PostController@index');

Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);

Route::group(['middleware' => ['auth']], function()
{
	Route::get('new-post','PostController@create');
	Route::post('new-post','PostController@store');
	Route::get('edit/{slug}','PostController@edit');
	Route::post('update','PostController@update');
	Route::get('delete/{id}','PostController@destroy');
	Route::get('my-all-posts','UserController@user_posts_all');
	Route::get('my-drafts','UserController@user_posts_draft');
	Route::post('comment/add','CommentController@store');
	Route::post('comment/delete/{id}','CommentController@distroy');
});

Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');

Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');

Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show']