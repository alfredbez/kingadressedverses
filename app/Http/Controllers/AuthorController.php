<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Controllers\Controller;

use App\Author;

use \Auth;

class AuthorController extends Controller {

	private $author;

	public function __construct(Author $author)
	{
		$this->author = $author;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->author->all();
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
	public function store(StoreAuthorRequest $request)
	{
		if(Auth::check())
		{
			$author = new Author();
			$author->name = $request->input('name');
			return json_encode([
					'saved' => $author->save(),
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
		$author = $this->author->find($id);
		return view('poems.index', [
			'poems' => $author->poems,
			'listname' => 'Alle Gedichte des Autors "' . $author->name . '"',
			'errorNoPoems' => 'Es gibt leider noch keine Gedichte des Autors "' . $author->name . '"',
			'filter' => 'author',
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
			$author = $this->author->find($id);
			return view('forms.rename', [
				'model' => 'author',
				'data' => $author
				]);
		}
		else
		{
			return redirect()->route('author.show', ['id' => $id]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoreAuthorRequest $request)
	{
		if(Auth::check())
		{
			/* Author bearbeiten */
			$old = $this->author->find($id);
			$oldname = $old->name;
			$new = $request->all();
			$old->update($new);
			return redirect()
							->route('author.show', ['id' => $id])
							->with('success', 'Autor <i>' . $oldname . '</i>'
																 . ' erfolgreich umbenannt');
		}
		return redirect()->route('author.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$author = $this->author->find($id);
		if(count( $author->poems ) > 0)
		{
			return redirect()->back()
							->with('info', 'Es gibt noch Gedichte von diesem Autor,'
																 . ' deshalb kannst du den Autor nicht löschen');
		}
		$authorName = $author->name;
		$author->delete();
		return redirect()
						->route('poem.index')
						->with('success', 'Der Autor <i>' . $authorName . '</i>'
															 . ' wurde erfolgreich gelöscht');
	}

}
