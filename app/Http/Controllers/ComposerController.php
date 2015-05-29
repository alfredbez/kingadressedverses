<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreComposerRequest;
use App\Http\Controllers\Controller;

use App\Composer;

use Auth;

class ComposerController extends Controller {

	private $composer;

	public function __construct(Composer $composer)
	{
		$this->composer = $composer;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->composer->all();
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
	public function store(StoreComposerRequest $request)
	{
		if(Auth::check())
		{
			$composer = new Composer();
			$composer->name = $request->input('name');
			return json_encode([
					'saved' => $composer->save(),
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
		$composer = $this->composer->find($id);
		return view('songs.index', [
			'songs' => $composer->songs,
			'listname' => 'Alle Lieder des Komponisten "' . $composer->name . '"',
			'errorNoSongs' => 'Es gibt leider noch keine Lieder des Komponisten "' . $composer->name . '"'
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
