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

// public pages
Route::get('/', ['uses' => 'PagesController@getDashboard', 'as' => 'dashboard']);
Route::get('dashboard', ['uses' => 'PagesController@getDashboard', 'as' => 'dashboard']);
Route::get('licence', ['uses' => 'PagesController@getLicence', 'as' => 'licence']);
Route::get('user_error', ['uses' => 'PagesController@getUserError', 'as' => 'user_error']);

// Auth pages
Auth::routes();
Route::get('password/change', ['uses' => 'Auth\ChangePasswordController@showChangePasswordForm', 'as' => 'password.change']);
Route::post('password/change', ['uses' => 'Auth\ChangePasswordController@change', 'as' => 'password.change']);

Route::get ('roles/{id}/delete', ['uses' => 'RolesController@delete', 'as' => 'roles.delete']);
Route::resource ('roles', 'RolesController' );

Route::get ('users/{id}/delete', ['uses' => 'UsersController@delete', 'as' => 'users.delete']);
Route::resource ('users', 'UsersController' );

Route::get ('categories/{id}/delete', ['uses' => 'CategoriesController@delete', 'as' => 'categories.delete']);
Route::resource ('categories', 'CategoriesController' );

Route::get ('news/{id}/delete', ['uses' => 'NewsController@delete', 'as' => 'news.delete']);
Route::resource ('news', 'NewsController' );

Route::get ('posts/{id}/delete', ['uses' => 'PostsController@delete', 'as' => 'posts.delete']);
Route::resource ('posts', 'PostsController' );

Route::resource ('profiles', 'ProfilesController' );

//Route::get('/home', 'HomeController@index')->name('home');