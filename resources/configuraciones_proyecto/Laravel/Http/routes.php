<?php

Route::group(['middleware' => 'web', 'prefix' => 'robotica', 'namespace' => 'Modules\Robotica\Http\Controllers'], function()
{
		
	Route::resource('/tutor', 'TutoriaController');

	Route::patch('/tutor/{id}',
	        [
	            'uses' => 'TutoriaController@update'
	        ]);

	Route::put('/tutor/{id}',
	        [
	            'uses' => 'TutoriaController@update'
	        ]);


	Route::get('/tutor/{id}',
	        [
	            'uses' => 'TutoriaController@show'
	        ]);

	Route::delete('/tutor/{id}',
	        [
	            'uses' => 'TutoriaController@destroy'
	        ]);
});

