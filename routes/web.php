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
Route::get('newsdashboard', ['uses' => 'PagesController@getNews', 'as' => 'newsdashboard']);
Route::get('blogdashboard', ['uses' => 'PagesController@getBlog', 'as' => 'blogdashboard']);
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
Route::get ('users/{id}/show_profile', ['uses' => 'UsersController@show_profile', 'as' => 'users.show_profile']);
Route::get ('users/{id}/edit_profile', ['uses' => 'UsersController@edit_profile', 'as' => 'users.edit_profile']);
Route::post ('users/{id}/update_profile', ['uses' => 'UsersController@update_profile', 'as' => 'users.update_profile']);

Route::get ('categories/{id}/delete', ['uses' => 'CategoriesController@delete', 'as' => 'categories.delete']);
Route::resource ('categories', 'CategoriesController' );

Route::get ('news/{id}/delete', ['uses' => 'NewsController@delete', 'as' => 'news.delete']);
Route::get ('news/all', ['uses' => 'NewsController@all', 'as' => 'news.all']);
Route::resource ('news', 'NewsController' );

Route::get ('blog/{id}/delete', ['uses' => 'BlogController@delete', 'as' => 'blog.delete']);
Route::get ('blog/all', ['uses' => 'BlogController@all', 'as' => 'blog.all']);
Route::get ('blog/{id}/show_public', ['uses' => 'BlogController@show_public', 'as' => 'blog.show_public']);
Route::resource ('blog', 'BlogController' );

Route::resource ('profiles', 'ProfilesController' );

//Route::get('/home', 'HomeController@index')->name('home');