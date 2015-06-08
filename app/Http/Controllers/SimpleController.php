<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HasItem;
use App\Http\Controllers\SimpleBaseTrait;

use Auth;

use Illuminate\Http\Request;

class SimpleController extends Controller {

	use HasItem;

	/* 'song' oder 'poem' */
	protected $type;

	protected $messages = [];

	protected function getSingularName()
	{
		switch ($this->type)
		{
			case 'song':
				return 'Lied';
				break;
			case 'poem':
				return 'Gedicht';
				break;
		}
	}

	protected function getPluralName()
	{
		switch ($this->type)
		{
			case 'song':
				return 'Lieder';
				break;
			case 'poem':
				return 'Gedichte';
				break;
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->item->all();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->item->find($id);
		$typeName = $this->type . 's';
				return view( $typeName . '.index', [
					$typeName => $item->{$typeName}()->ordered(),
					'listname' => 'Alle ' . $this->getPluralName() . ' ' . $this->messages['inItem'] . ' "' . $item->name . '"',
					'errorNoSongs' => 'Es gibt leider noch keine ' . $this->getPluralName() . ' ' . $this->messages['inItem'] . ' "' . $item->name . '"',
					'filter' => $this->itemName,
					'id' => $id,
					]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Auth::check())
		{
			$item = $this->item->find($id);
			return view('forms.rename', [
				'model' => $this->itemName,
				'data' => $item
				]);
		}
		else
		{
			return redirect()->route( $this->itemName . '.show', ['id' => $id]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::check())
		{
			$item = $this->item->find($id);
			$linkedModelName = $this->type . 's';
			if(count( $item->{$linkedModelName} ) > 0)
			{
				return back()
								->with('info', $this->messages['deleteItemHasItems']);
			}
			$itemName = $item->name;
			$item->delete();
			return redirect()
							->route( $this->type . '.index')
							->with('success', ucwords($this->messages['itemWithNounMarker'])
																 . ' <i>' . $itemName . '</i>'
																 . ' wurde erfolgreich gelöscht');
		}
		else {
			return \App::abort(403, 'Access denied');
		}
	}

}
