<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Song;
use App\Category;
use App\Composer;
use App\Orchestration;
use App\File;

use Illuminate\Http\Request;

use Storage;

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
				'data' 						=> [],
			]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$song = Song::create($request->all());

		$this->uploadFiles($request, $song->id);

		return redirect('song');
	}

	private function uploadFiles(Request $request, $songId)
	{
		/* Dateien hochladen und speichern */
		if($request->hasFile('files'))
		{
			foreach($request->file('files') as $uploadedFile)
			{
				$file = new File();

				/* App\File@setNameAttribute */
				$file->name = $uploadedFile->getClientOriginalName();

				$file->type = $uploadedFile->guessClientExtension();

				$file->song_id = $songId;

				$file->save();

				/* App\File@getFilenameAttribute */
				$filename = $file->filename;

				Storage::disk('local')->put($file->filename, \Illuminate\Support\Facades\File::get($uploadedFile));
			}
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
		return view('songs.detail', [
			'song' => $this->song->withTrashed()->where('id', $id)->first()
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
		$song = $this->song->find($id);
		return view('songs.form', [
				'categories' 			=> Category::all(),
				'composers'  			=> Composer::all(),
				'orchestrations' 	=> Orchestration::all(),
				'data' 						=> $song,
				'formtitle' 			=> 'Lied "' . $song->title . '" bearbeiten',
			]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		/* gelöschtes Lied wiederherstellen */
		if($request->has('restore'))
		{
			$this->song->withTrashed()->where('id', $id)->first()->restore();
			return redirect('song');
		}

		/* Lied bearbeiten */
		$old = $this->song->find($id);
		$new = $request->all();
		$old->update($new);
		$this->uploadFiles($request, $id);
		return redirect()->route('song.show', [$old]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		/* Lied aus Papierkorb löschen */
		if($request->has('sure'))
		{
			$this->song->withTrashed()->where('id', $id)->first()->forceDelete();
			return redirect('song');
		}
		$this->song->find($id)->delete();
		return redirect('song');
	}

	public function trash()
	{
		return view('songs.index', [
			'songs' => $this->song->onlyTrashed()->get(),
			'listname' => 'Alle gelöschten Lieder',
			'errorNoSongs' => 'Es gibt keine gelöschten Lieder',
			]);
	}

}
