<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Song extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

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
