<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\File;

use Storage;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class FileController extends Controller {

	public function __construct(File $file)
	{
		$this->file = $file;
	}

	public function show($id)
	{
		$file = $this->file->find($id);

		if (Storage::disk('local')->exists($file->filename)) {
		  $mime_type = Storage::mimetype($file->filename);
		  if ($mime_type) {
		  	return Response::download(
		  		storage_path() . '/app/' . $file->filename,
		  		$file->downloadname,
		  		['Content-Type' => $mime_type]
		  	);
		  } else {
		    return Response::make("unbekannter MIME-Type <b>$mime_type</b>", 404);
		  }
		}

		return Response::make('Die Datei wurde nicht gefunden', 404);
	}

	public function update($id, Request $request)
	{
		$this->file->find($id)->update(['name' => $request->name]);
	}

}
