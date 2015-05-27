<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

	public function setNameAttribute($name)
	{
		$name = pathinfo($name)['filename'];
		$name = trim(str_replace('_', ' ', $name));
		$this->attributes['name'] = $name;
	}

	public function getFilenameAttribute()
  {
      return 'file' . $this->id . '.' . $this->type;
  }

	public function getDownloadnameAttribute()
  {
      return str_replace('_', ' ', $this->name) . '.' . $this->type;
  }

}
