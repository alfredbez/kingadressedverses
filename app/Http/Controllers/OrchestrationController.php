<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreOrchestrationRequest;
use App\Http\Controllers\Controller;

use App\Orchestration;

class OrchestrationController extends Controller {

	private $orchestration;

	public function __construct(Orchestration $orchestration)
	{
		$this->orchestration = $orchestration;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->orchestration->all();
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
	public function store(StoreOrchestrationRequest $request)
	{
		$orchestration = new Orchestration();
		$orchestration->name = $request->input('name');
		return json_encode([
				'saved' => $orchestration->save(),
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
		$orchestration = $this->orchestration->find($id);
		return view('songs.index', [
			'songs' => $orchestration->songs,
			'listname' => 'Alle Lieder mit der Besetzung "' . $orchestration->name . '"',
			'errorNoSongs' => 'Es gibt leider noch keine Lieder mit der Besetzung "' . $orchestration->name . '"'
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
