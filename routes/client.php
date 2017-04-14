<?php
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::group(['prefix' => 'tutorial'], function() {
    Route::get('/', [ 'uses' => 'TutorialController@getIndex', 'as' => 'tutorial']);
    Route::get('/{slug}', [ 'uses' => 'TutorialController@getDetail', 'as' => 'tutorial.detail']);
});