<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	//protected user = $user = User::where('api_token', '=', Request::header('X-Auth-Token'))->firstOrFail();
	//echo " adssad ".Request::header('X-Auth-Token');

	public static function user() {
		return  User::where('api_token', '=', Request::header('X-Auth-Token'))->firstOrFail();
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
