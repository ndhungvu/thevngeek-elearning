<?php

Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('/login', 'AuthController@postLogin');

Route::group(['middleware' => 'auth'], function() {
	Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
    Route::get('/', ['as'=>'dashboard', 'uses'=>'DashboardsController@getIndex']);

    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('document', 'DocumentController');
    Route::resource('comment', 'CommentController', ['except' => [
        'create', 'store'
    ]]);

    /*Articles*/
    Route::resource('article', 'ArticleController');
    /*Session*/
    Route::resource('sesson', 'SessonController');
    Route::get('/sesson/{id}/question', ['as' => 'sesson.question','uses' => 'SessonController@getQuestion' ]);
    Route::post('/sesson/{id}/question', ['uses' => 'SessonController@postQuestion']);
});
