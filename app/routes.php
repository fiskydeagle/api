<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => 'api', 'before' => 'auth.token'), function() {

    Route::get('/', array('as' => 'me', 'uses' => 'UserController@index'));

}); 

Route::group(array('prefix' => 'api'), function() {

    Route::post('login',function()
    {
        try
        {
            $user = Sentry::authenticate(Input::all(), false);

            $token = hash('sha256',Str::random(10),false);

            $user->api_token = $token;

            $user->save();

            return Response::json(array('error' => false, 'token' => $token, 'user' => $user->toArray()));
        }
        catch(Exception $e)
        {
            App::abort(404,$e->getMessage());
        }
    });
    Route::post('register', array('as' => 'register', 'uses' => 'UserController@register'));

}); 