<?php namespace App\Http\Requests;

use \Auth;

trait LoggedInOnly {
	public function authorize()
	{
		// Requests sollen nur von angemeldeten
		// Nutzern akzeptiert werden
		if(Auth::check())
		{
			return true;
		}
		return false;
	}
}