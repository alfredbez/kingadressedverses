<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequest;
use App\Http\Controllers\ItemController;

use App\Song;

class SongController extends ItemController {

	use BaseTrait {
		store as baseStore;
		update as baseUpdate;
	}

	public function __construct(Song $song)
	{
		$this->item = $song;
		$this->itemName = 'song';
		$this->itemDisplayName = 'Lied';
		$this->itemDisplayNamePlural = 'Lieder';
	}

	public function store(StoreSongRequest $request)
	{
		$this->baseStore($request);
	}

	public function update($id, StoreSongRequest $request)
	{
		return $this->baseUpdate($id, $request);
	}

}
