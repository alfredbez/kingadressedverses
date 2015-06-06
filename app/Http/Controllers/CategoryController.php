<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Controllers\SimpleController;

use App\Category;

use Auth;

class CategoryController extends SimpleController {

	use SimpleBaseTrait {
		store as baseStore;
		update as baseUpdate;
	}

	protected $messages = [
		'inItem' 							=> 'in der Kategorie',
		'itemWithNounMarker'  => 'die Kategorie',
		'deleteItemHasItems' 	=> 'Es gibt noch Lieder in dieser Kategorie, deshalb kannst du sie nicht löschen',
	];

	public function __construct(Category $category)
	{
		$this->item = $category;

		$this->itemName = 'category';
		$this->itemDisplayName = 'Thema';
		$this->itemDisplayNamePlural = 'Themen';
		$this->type = 'song';
	}

	public function store(StoreCategoryRequest $request)
	{
	  return $this->baseStore($request);
	}

	public function update($id, StoreCategoryRequest $request)
	{
	  return $this->baseUpdate($id, $request);
	}

}
