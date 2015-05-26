<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Song;
use App\Category;
use App\Composer;
use App\Orchestration;

use Illuminate\Http\Request;

class SongController extends Controller {

	private $song;

	public function __construct(Song $song)
	{
		$this->song = $song;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('songs.index', ['songs' => $this->song->all()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('songs.form', [
				'categories' 			=> Category::all(),
				'composers'  			=> Composer::all(),
				'orchestrations' 	=> Orchestration::all(),
			]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$song = new Song();
		$song->title = $request->input("title");
		$song->original_title = $request->input("original_title");
		$song->category_id = $request->input("category");
		$song->composer_id = $request->input("composer");
		$song->orchestration_id = $request->input("orchestration");

		$song->save();

		return redirect('song');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$this->middleware('admin');
		return view('songs.detail', ['song' => $this->song->find($id)]);
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
