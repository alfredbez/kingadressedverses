<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = ['name'];

	public function poems()
	{
		return $this->hasMany('App\Poem');
	}

}
