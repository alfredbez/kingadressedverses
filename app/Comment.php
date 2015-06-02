<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = [
		'author',
		'email',
		'comment',
	];

	public function commentable()
  {
      return $this->morphTo();
  }

  public function scopePublished($query)
  {
  	return $query->where('published', 1);
  }

}
