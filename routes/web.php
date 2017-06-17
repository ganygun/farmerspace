<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */
Route::resource('/', 'HomeController');

/**
 * Loading Content
 */
Route::get('/news/page/{id}', array('uses' => 'NewsController@getPost'));
Route::get('/video/page/{id}', array('uses' => 'VideoController@getPost'));
Route::get('/event/page/{id}', array('uses' => 'EventController@getPost'));

Route::resource('/news', 'NewsController');
Route::resource('/video', 'VideoController');
Route::resource('/event', 'EventController');

// ------------ Admin ----------------------------------------

// route to show the login form
Route::get('admins', array('uses' => 'Admins\LoginController@showLogin'));

// route to process the form
Route::post('admins/login', array('uses' => 'Admins\LoginController@doLogin'));

Route::get('admins/logout', array('uses' => 'Admins\LoginController@doLogout'));

Route::get('admins/dashboard', array('uses' => 'Admins\DashboardController@Index'));

// ------------ Search --------------------------
Route::get('admins/search', array('uses' => 'Admins\ProductController@SearchProduct'));
Route::get('admins/form/search', array('uses' => 'Admins\FormController@SearchFormProduct'));
Route::get('admins/writing/search', array('uses' => 'Admins\WritingController@SearchNews'));
Route::get('admins/product/overview/search', array('uses' => 'Admins\OverviewController@SearchSpecies'));
Route::get('/search', array('uses' => 'HomeController@Search'));
// ----------------------------------------------

// ------------ Admin Register Choose Job --------------------------
Route::resource('admins/register', 'Admins\RegisterController');
// ----------------------------------------------
// ------------ Admin Confirm to Regsiter Job Admin --------------------------
Route::post('admins/register/confirm_register', array('uses' => 'Admins\RegisterController@confirm_register'));

// ----------------------------------------------

Route::resource('admins/product', 'Admins\ProductController');
Route::resource('admins/product/overview', 'Admins\OverviewController');

Route::resource('admins/form', 'Admins\FormController');
Route::resource('admins/writing', 'Admins\WritingController');
Route::resource('admins/verify', 'Admins\VerifyController');
Route::resource('admins/profile', 'Admins\AdminController');
Route::resource('admins/myarticle', 'Admins\MyArticleController');

Route::post('admins/writing/{id}/edit', 'Admins\WritingController@edit');

Route::get('/admins/register/confirm_register/checkUser/{username}', array('uses' => 'Admins\RegisterController@checkUser'));
