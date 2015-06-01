<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poem extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'title',
		'author_id',
		'topic_id',
	];

	public function files()
	{
		return $this->hasMany('App\File');
	}

	public function topic()
	{
		return $this->belongsTo('App\Topic');
	}

	public function author()
	{
		return $this->belongsTo('App\Author');
	}

	public function scopeOrdered($query)
	{
		return $query->orderBy('created_at', 'desc')->get();
	}

}
