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

// Route model binding
Route::model('review', 'App\ReviewItem');

// Redirect from '/' to '/review'
Route::get('/', function() {
	return redirect('/review');
});

// Routes that require auth
Route::group(['middleware' => 'auth'], function() {
    // full REST resource
	Route::resource('review', 'ReviewController');

    // Additional routes for Review resource
    // Mark topic as reviewed
	Route::patch('review/{review}/markReviewed', 
		['as' => 'review.markReviewed', 'uses' => 'ReviewController@markReviewed']
	);

    // Delete a topic
	Route::get('review/{review}/delete', 
		['as' => 'review.delete', 'uses' => 'ReviewController@delete']
	);

    // Reset review progress
	Route::patch('review/{review}/reset',
		['as' => 'review.reset', 'uses' => 'ReviewController@reset']
	);
});

// Authentication routes
Route::get('auth/login', ['as' => 'auth.showLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes
Route::get('auth/register', ['as' => 'auth.showRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);
