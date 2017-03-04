<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware' => ['web']], function(){
	Route::get('/', function () {
	    return view('welcome');
	})->name('home');

	Route::post('/registrarse', [
		'uses' => 'UserController@postSignUp',
		'as' => 'signup'
	]);

	Route::post('/iniciar-sesion', [
		'uses' => 'UserController@postSignIn',
		'as' => 'signin'
	]);

	Route::get('/cerrar-sesion', [
		'uses' => 'UserController@getLogout',
		'as' => 'logout'
	]);

	Route::get('/cuenta', [
		'uses' => 'UserController@getAccount',
		'as' => 'account'
	]);

	Route::post('/actualizar-cuenta', [
		'uses' => 'UserController@postSaveAccount',
		'as' => 'account.save'
	]);

	Route::get('/usuarioimg/{filename}', [
		'uses' => 'UserController@getUserImage',
		'as' => 'account.image'
	]);

	Route::get('/dashboard', [
		'uses' => 'PostController@getDashboard',
		'as' => 'dashboard',
		'middleware' => 'auth'
	]);

	Route::post('/crear-post', [
		'uses' => 'PostController@postCreatePost',
		'as' => 'post.create',
		'middleware' => 'auth'
	]);

	Route::get('/borrar-post/{post_id}', [
		'uses' => 'PostController@getDeletePost',
		'as' => 'post.delete',
		'middleware' => 'auth'
	]);

	Route::post('/editar', [
		'uses' => 'PostController@postEditPost',
		'as' => 'edit'
	]);

	Route::post('/me-gusta', [
		'uses' => 'PostController@postLikePost',
		'as' => 'like'
	]);
//});