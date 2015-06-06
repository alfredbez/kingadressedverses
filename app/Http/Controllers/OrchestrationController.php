<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreOrchestrationRequest;
use App\Http\Controllers\SimpleController;

use App\Orchestration;

use Auth;

class OrchestrationController extends SimpleController {

	use SimpleBaseTrait {
	  store as baseStore;
	  update as baseUpdate;
	}

	protected $messages = [
    'inItem'              => 'mit der Besetzung',
    'itemWithNounMarker'  => 'die Besetzung',
    'deleteItemHasItems'  => 'Es gibt noch Lieder mit dieser Besetzung, deshalb kann die Besetzung nicht gelöscht werden',
  ];

  private $orchestration;

	public function __construct(Orchestration $orchestration)
	{
		$this->item = $orchestration;

    $this->itemName = 'orchestration';
    $this->itemDisplayName = 'Besetzung';
    $this->itemDisplayNamePlural = 'Besetzungen';
    $this->type = 'song';
	}

	public function store(StoreOrchestrationRequest $request)
	{
	  return $this->baseStore($request);
	}

	public function update($id, StoreOrchestrationRequest $request)
	{
	  return $this->baseUpdate($id, $request);
	}
}
