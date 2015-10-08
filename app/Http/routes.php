<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/* Route model binding */
Route::model('review', 'App\ReviewItem');

Route::get('/', function() {
	return redirect('/review');
});

/* Review routes */
Route::group(['prefix' => 'review/{review}'], function() {
    Route::patch('markReviewed', 
        ['as' => 'review.markReviewed', 'uses' => 'ReviewController@markReviewed']
    );
    Route::get('delete', 
        ['as' => 'review.delete', 'uses' => 'ReviewController@delete']
    );
    Route::patch('reset',
        ['as' => 'review.reset', 'uses' => 'ReviewController@reset']
    );
});
Route::resource('review', 'ReviewController');

/* Auth routes */
Route::get('auth/login', ['as' => 'auth.showLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::get('auth/register', ['as' => 'auth.showRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);
