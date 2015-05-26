<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Orchestration extends Model {

	public function songs()
	{
		return $this->hasMany('App\Song');
	}

}
