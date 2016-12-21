<?php

Route::get('/', function() {
    return redirect('/review');
});

/* Review routes */
Route::group(['prefix' => 'review/{id}'], function() {
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

Route::get('review/create', ['as' => 'review.create', 'uses' => 'ReviewController@create']);
Route::get('review', ['as' => 'review.index', 'uses' => 'ReviewController@index']);
Route::post('review', ['as' => 'review.store', 'uses' => 'ReviewController@store']);
Route::get('review/{id}', ['as' => 'review.show', 'uses' => 'ReviewController@show']);
Route::get('review/{id}/edit', ['as' => 'review.edit', 'uses' => 'ReviewController@edit']);
Route::patch('review/{id}', ['as' => 'review.update', 'uses' => 'ReviewController@update']);
Route::delete('review/{id}', ['as' => 'review.destroy', 'uses' => 'ReviewController@destroy']);

/* Auth routes */
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@register']);
