<?php namespace App\Http\Controllers;

use App\Http\Requests\StorePoemRequest;
use App\Http\Controllers\Controller;

use App\Poem;
use App\File;

use Auth;
use Storage;

use Illuminate\Http\Request;

class PoemController extends Controller {

	private $poem;

	public function __construct(Poem $poem)
	{
		$this->poem = $poem;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('poems.index', ['poems' => $this->poem->all()]);
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
			return view('poems.form', ['data' => []]);
		}
		else
		{
			return redirect('poem');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StorePoemRequest $request)
	{
		if(Auth::check())
		{
			$poem = Poem::create($request->all());
			$this->uploadFiles($request, $poem->id);
			return redirect('poem');
		}
	}

	private function uploadFiles(StorePoemRequest $request, $poemId)
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

				$file->poem_id = $poemId;

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
		return view('poems.detail', [
			'poem' => $this->poem->withTrashed()->where('id', $id)->first()
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
			$poem = $this->poem->find($id);
			return view('poems.form', [
					'data' 			=> $poem,
					'formtitle' => 'Gedicht "' . $poem->title . '" bearbeiten',
				]);
		}
		else
		{
			return redirect('poem');
		}
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
	public function destroy($id, Request $request)
	{
		if(Auth::check())
		{
			/* Gedicht aus Papierkorb löschen */
			if($request->has('sure'))
			{
				$this->poem->withTrashed()->where('id', $id)->first()->forceDelete();
				return redirect('poem');
			}
			/* Lied in Papierkorb legen */
			$this->poem->find($id)->delete();
			return redirect('poem');
		}
		else
		{
			return redirect('poem');
		}
	}

	public function trash()
	{
		if(Auth::check())
		{
			return view('poems.index', [
				'poems' => $this->poem->onlyTrashed()->get(),
				'listname' => 'Alle gelöschten Gedichte',
				'errorNoPoems' => 'Es gibt keine gelöschten Gedichte',
				]);
		}
		else
		{
			return redirect('poem');
		}
	}

}
