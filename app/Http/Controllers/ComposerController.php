<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreComposerRequest;
use App\Http\Controllers\SimpleController;

use App\Composer;

use Auth;

class ComposerController extends SimpleController {

  use SimpleBaseTrait {
    store as baseStore;
    update as baseUpdate;
  }

  protected $messages = [
    'inItem'              => 'des Komponisten',
    'itemWithNounMarker'  => 'der Komponist',
    'deleteItemHasItems'  => 'Es gibt noch Lieder von diesem Komponisten, deshalb kann der Komponist nicht gelöscht werden',
  ];

	private $composer;

	public function __construct(Composer $composer)
	{
		$this->item = $composer;

    $this->itemName = 'composer';
    $this->itemDisplayName = 'Komponist';
    $this->itemDisplayNamePlural = 'Komponisten';
    $this->type = 'song';
	}

	public function store(StoreComposerRequest $request)
	{
	  return $this->baseStore($request);
	}

	public function update($id, StoreComposerRequest $request)
	{
	  return $this->baseUpdate($id, $request);
	}
}
