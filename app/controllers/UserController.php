<?php

class UserController extends BaseController {

	/*
	
	*/

	public function index()
	{
		return Response::json(array('user' => $this->user()));
	}

}
