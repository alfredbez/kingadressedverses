<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreSongRequest;
use App\Http\Controllers\Controller;

use App\Song;
use App\Category;
use App\Composer;
use App\Orchestration;
use App\File;

// use Illuminate\Http\Request;

use Storage;
use Auth;

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
		if(Auth::check())
		{
			return view('songs.form', [
					'categories' 			=> Category::all(),
					'composers'  			=> Composer::all(),
					'orchestrations' 	=> Orchestration::all(),
					'data' 						=> [],
				]);
		}
		else
		{
			return redirect('song');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreSongRequest $request)
	{
		if(Auth::check())
		{
			$song = Song::create($request->all());
			$this->uploadFiles($request, $song->id);
			return redirect('song');
		}
		else
		{
			return redirect('song');
		}
	}

	private function uploadFiles(StoreSongRequest $request, $songId)
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
		if(Auth::check())
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
		else
		{
			return redirect('song');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoreSongRequest $request)
	{
		if(Auth::check())
		{
			/* Lied bearbeiten */
			$old = $this->song->find($id);
			$new = $request->all();
			$old->update($new);
			$this->uploadFiles($request, $id);
			return redirect()->route('song.show', [$old]);
		}
		else
		{
			return redirect('song');
		}
	}

	public function restore($id, Request $request)
	{
		if(Auth::check())
		{
			/* gelöschtes Lied wiederherstellen */
			if($request->has('restore'))
			{
				$this->song->withTrashed()->where('id', $id)->first()->restore();
				return redirect('song');
			}
		}
		else
		{
			return redirect('song');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		if(Auth::check())
		{
			/* Lied aus Papierkorb löschen */
			if($request->has('sure'))
			{
				$this->song->withTrashed()->where('id', $id)->first()->forceDelete();
				return redirect('song');
			}
			/* Lied in Papierkorb legen */
			$this->song->find($id)->delete();
			return redirect('song');
		}
		else
		{
			return redirect('song');
		}
	}

	public function trash()
	{
		if(Auth::check())
		{
			return view('songs.index', [
				'songs' => $this->song->onlyTrashed()->get(),
				'listname' => 'Alle gelöschten Lieder',
				'errorNoSongs' => 'Es gibt keine gelöschten Lieder',
				]);
		}
		else
		{
			return redirect('song');
		}
	}

}
