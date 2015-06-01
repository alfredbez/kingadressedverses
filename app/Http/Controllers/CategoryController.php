<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Controllers\Controller;

use App\Category;

use Auth;

class CategoryController extends Controller {

	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->category->all();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreCategoryRequest $request)
	{
		if(Auth::check())
		{
			$category = new Category();
			$category->name = $request->input('name');
			return json_encode([
					'saved' => $category->save(),
					'name' => $request->input('name')
				]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = $this->category->find($id);
		return view('songs.index', [
			'songs' => $category->songs()->ordered(),
			'listname' => 'Alle Lieder in der Kategorie "' . $category->name . '"',
			'errorNoSongs' => 'Es gibt leider noch keine Lieder in der Kategorie "' . $category->name . '"',
			'filter' => 'category',
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
			$category = $this->category->find($id);
			return view('forms.rename', [
				'model' => 'category',
				'data' => $category
				]);
		}
		else
		{
			return redirect()->route('category.show', ['id' => $id]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoreCategoryRequest $request)
	{
		if(Auth::check())
		{
			/* Category bearbeiten */
			$old = $this->category->find($id);
			$oldname = $old->name;
			$new = $request->all();
			$old->update($new);
			return redirect()
							->route('category.show', ['id' => $id])
							->with('success', 'Kategorie <i>' . $oldname . '</i>'
																 . ' erfolgreich umbenannt');
		}
		return redirect()->route('category.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = $this->category->find($id);
		if(count( $category->songs ) > 0)
		{
			return redirect()->back()
							->with('info', 'Es gibt noch Lieder in dieser Kategorie,'
																 . ' deshalb kannst du sie nicht löschen');
		}
		$categoryName = $category->name;
		$category->delete();
		return redirect()
						->route('song.index')
						->with('success', 'Die Kategorie <i>' . $categoryName . '</i>'
															 . ' wurde erfolgreich gelöscht');
	}

}
