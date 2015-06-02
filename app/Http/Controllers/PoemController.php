<?php namespace App\Http\Controllers;

use App\Http\Requests\StorePoemRequest;
use App\Http\Controllers\ItemController;

use App\Poem;

class PoemController extends ItemController {

	use BaseTrait {
		store as baseStore;
		update as baseUpdate;
	}

	public function __construct(Poem $poem)
	{
		$this->item = $poem;
		$this->itemName = 'poem';
		$this->itemDisplayName = 'Gedicht';
		$this->itemDisplayNamePlural = 'Gedichte';
	}

	public function store(StorePoemRequest $request)
	{
		$this->baseStore($request);
	}

	public function update($id, StorePoemRequest $request)
	{
		return $this->baseUpdate($id, $request);
	}

}
