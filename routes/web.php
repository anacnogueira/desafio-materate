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



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
    	return view('home');
	});

	Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
	Route::get('/perfil', ['as' =>'user.profile', 'uses' => 'UsersController@profile']);

	/* --- Users --- */
		Route::group(['prefix'=>'usuarios'], function(){
			Route::get('/', ['as' =>'user.index', 'uses' => 'UsersController@index']);
			Route::get('excluidos/{deleted}', ['as' =>'user.deleted', 'uses' => 'UsersController@index']);

			Route::get('adicionar', ['as' => 'user.create', 'uses' => 'UsersController@create']);
			Route::post('store', ['as' => 'user.store', 'uses' => 'UsersController@store']);
			Route::get('editar/{id}', ['as' => 'user.edit', 'uses' => 'UsersController@edit']);
			Route::put('update/{id}', ['as' => 'user.update', 'uses' => 'UsersController@update']);
			Route::delete('excluir/{id}', ['as' => 'user.destroy', 'uses' => 'UsersController@destroy']);
		});
});

Auth::routes();



Route::get('login',  ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
