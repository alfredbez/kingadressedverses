<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Controllers\SimpleController;

use App\Author;

use \Auth;

class AuthorController extends SimpleController {

  use SimpleBaseTrait {
    store as baseStore;
    update as baseUpdate;
  }

  protected $messages = [
    'inItem'              => 'des Autors',
    'itemWithNounMarker'  => 'der Autor',
    'deleteItemHasItems'  => 'Es gibt noch Gedichte von diesem Autor, deshalb kann der Autor nicht gelöscht werden',
  ];

	private $author;

	public function __construct(Author $author)
	{
		$this->item = $author;

      $this->itemName = 'author';
      $this->itemDisplayName = 'Autor';
      $this->itemDisplayNamePlural = 'Autoren';
      $this->type = 'poem';
	}

  public function store(StoreAuthorRequest $request)
  {
    return $this->baseStore($request);
  }

  public function update($id, StoreAuthorRequest $request)
  {
    return $this->baseUpdate($id, $request);
  }

}
