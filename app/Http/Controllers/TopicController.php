<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Controllers\SimpleController;

use App\Topic;

use \Auth;

class TopicController extends SimpleController {

	use SimpleBaseTrait {
	  store as baseStore;
	  update as baseUpdate;
	}

	protected $messages = [
    'inItem'              => 'mit dem Thema',
    'itemWithNounMarker'  => 'das Thema',
    'deleteItemHasItems'  => 'Es gibt noch Gedichte mit diesem Thema, deshalb kann das Thema nicht gelöscht werden',
  ];

  private $topic;

	public function __construct(Topic $topic)
	{
		$this->item = $topic;

    $this->itemName = 'topic';
    $this->itemDisplayName = 'Thema';
    $this->itemDisplayNamePlural = 'Themen';
    $this->type = 'poem';
	}

	public function store(StoreTopicRequest $request)
	{
	  return $this->baseStore($request);
	}

	public function update($id, StoreTopicRequest $request)
	{
	  return $this->baseUpdate($id, $request);
	}
}
