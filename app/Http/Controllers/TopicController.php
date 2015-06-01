<?php namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Controllers\Controller;

use App\Topic;

use \Auth;

class TopicController extends Controller {

	private $topic;

	public function __construct(Topic $topic)
	{
		$this->topic = $topic;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->topic->all();
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
	public function store(StoreTopicRequest $request)
	{
		if(Auth::check())
		{
			$topic = new Topic();
			$topic->name = $request->input('name');
			return json_encode([
					'saved' => $topic->save(),
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
		$topic = $this->topic->find($id);
		return view('poems.index', [
			'poems' => $topic->poems()->ordered(),
			'listname' => 'Alle Gedichte zum Thema "' . $topic->name . '"',
			'errorNoPoems' => 'Es gibt leider noch keine Gedichte zum Thema "' . $topic->name . '"',
			'filter' => 'topic',
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
			$topic = $this->topic->find($id);
			return view('forms.rename', [
				'model' => 'topic',
				'data' => $topic
				]);
		}
		else
		{
			return redirect()->route('topic.show', ['id' => $id]);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, StoreTopicRequest $request)
	{
		if(Auth::check())
		{
			/* Topic bearbeiten */
			$old = $this->topic->find($id);
			$oldname = $old->name;
			$new = $request->all();
			$old->update($new);
			return redirect()
							->route('topic.show', ['id' => $id])
							->with('success', 'Thema <i>' . $oldname . '</i>'
																 . ' erfolgreich umbenannt');
		}
		return redirect()->route('topic.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$topic = $this->topic->find($id);
		if(count( $topic->poems ) > 0)
		{
			return redirect()->back()
							->with('info', 'Es gibt noch Gedichte, die diesem Thema zugeordnet sind,'
																 . ' deshalb kannst du das Thema nicht löschen');
		}
		$topicName = $topic->name;
		$topic->delete();
		return redirect()
						->route('poem.index')
						->with('success', 'Das Thema <i>' . $topicName . '</i>'
															 . ' wurde erfolgreich gelöscht');
	}

}
