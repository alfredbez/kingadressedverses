<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Controllers\Controller;

use App\Category;

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
		$category = new Category();
		$category->name = $request->input('name');
		return json_encode([
				'saved' => $category->save(),
				'name' => $request->input('name')
			]);
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
			'songs' => $category->songs,
			'listname' => 'Alle Lieder in der Kategorie "' . $category->name . '"',
			'errorNoSongs' => 'Es gibt leider noch keine Lieder in der Kategorie "' . $category->name . '"'
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
