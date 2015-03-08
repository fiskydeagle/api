<?php

class UserController extends BaseController {

	/*
	
	*/

	public function index()
	{
		return Response::json(array('user' => $this->user()), 200);
	}

	public function register()
	{
		$validate = User::validateUser(Input::all());
        /** Register the user */
        if ($validate === true) {
            $user = Sentry::createUser(array(
		        'email'     => Input::get('email'),
		        'first_name'     => Input::get('first_name'),
		        'last_name'     => Input::get('last_name'),
		        'phone_nr'     => Input::get('phone_nr'),
		        'gender'     => Input::get('gender'),
		        'dob'     => Input::get('dob'),
		        'city_id'     => Input::get('city_id'),
		        'country_id'     => Input::get('country_id'),
		        'password'  => Input::get('password')
		    ));

            return Response::json(array('error' => false, 'user' => $this->user()), 200);
        }
        /** Validation Failed */
        return Response::json(array('error' => true, 'error_messages' => $validate), 422);
        //return Redirect::to('user/new')->withErrors($validate)->withInput(Input::except('password','password_confirmation'));
	}

}
