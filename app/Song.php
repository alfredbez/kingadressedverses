<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

	public function composer()
	{
		return $this->belongsTo('App\Composer');
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function orchestration()
	{
		return $this->belongsTo('App\Orchestration');
	}

	public function files()
	{
		return $this->hasMany('App\File');
	}

}
