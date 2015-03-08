<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public static function validateUser($data)
    {
        /** Validate Registration Data */
        $validator = Validator::make(
            $data,
            array(
                'email' => 'required|email|unique:users,email',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_nr' => 'required|unique:users,phone_nr',
                'gender' => 'required',
                'dob' => 'required',
                'city_id' => 'required|alpha_num',
                'country_id' => 'required|alpha_num',
                'password' => 'required| between: 6,16|confirmed',
                'password_confirmation' => 'required| between: 6,16'
            )
        );

        if ($validator->fails()) {
            return $validator->messages();
        }
        return true;
    }

    public static function validateUserMobile($data)
    {
        /** Validate Registration Data */
        $validator = Validator::make(
            $data,
            array(
                'email' => 'required|email|unique:users,email',
                'phone_nr' => 'required|unique:users,phone_nr'
            )
        );

        if ($validator->fails()) {
            return $validator->messages();
        }
        return true;
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
