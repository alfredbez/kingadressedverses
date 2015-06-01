<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreOrchestrationRequest;
use App\Http\Controllers\Controller;

use App\Orchestration;

use Auth;

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
		if(Auth::check())
		{
			$orchestration = new Orchestration();
			$orchestration->name = $request->input('name');
			return json_encode([
					'saved' => $orchestration->save(),
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
		$orchestration = $this->orchestration->find($id);
		return view('songs.index', [
			'songs' => $orchestration->songs()->ordered(),
			'listname' => 'Alle Lieder mit der Besetzung "' . $orchestration->name . '"',
			'errorNoSongs' => 'Es gibt leider noch keine Lieder mit der Besetzung "' . $orchestration->name . '"',
			'filter' => 'orchestration',
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
			$orchestration = $this->orchestration->find($id);
			return view('forms.rename', [
				'model' => 'orchestration',
				'data' => $orchestration
				]);
		}
		else
		{
			return redirect()->route('orchestration.show', ['id' => $id]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoreOrchestrationRequest $request)
	{
		if(Auth::check())
		{
			/* Orchestration bearbeiten */
			$old = $this->orchestration->find($id);
			$oldname = $old->name;
			$new = $request->all();
			$old->update($new);
			return redirect()
							->route('orchestration.show', ['id' => $id])
							->with('success', 'Besetzung <i>' . $oldname . '</i>'
																 . ' erfolgreich umbenannt');
		}
		return redirect()->route('orchestration.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$orchestration = $this->orchestration->find($id);
		if(count( $orchestration->songs ) > 0)
		{
			return redirect()->back()
							->with('info', 'Es gibt noch Lieder mit dieser Besetzung.'
															. ' Deshalb kannst du diese Besetzung nicht löschen');
		}
		$orchestrationName = $orchestration->name;
		$orchestration->delete();
		return redirect()
						->route('song.index')
						->with('success', 'Die Besetzung <i>' . $orchestrationName . '</i>'
															 . ' wurde erfolgreich gelöscht');
	}

}
