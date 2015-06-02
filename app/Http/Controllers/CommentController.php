<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller {

	protected $comment;
	protected $relatedModel;

	public function __construct (Comment $comment)
	{
		$this->comment = $comment;
		$this->middleware('auth');
	}

	protected function redirect()
	{
		$classname = class_basename(get_class($this->relatedModel));
		$redirectRoute = strtolower($classname) . '.show';
		return redirect()->route($redirectRoute, [$this->relatedModel]);
	}

	protected function getComment($id)
	{
		$comment = $this->comment->find($id);
		$this->relatedModel = $comment->commentable;

		return $comment;
	}

	public function publish($id)
	{
		$comment = $this->getComment($id);

		$comment->published = true;
		$comment->save();

		return $this->redirect()
								->with(	'success',
												'Kommentar erfolgreich veröffentlicht');
	}

	public function destroy($id)
	{
		$comment = $this->getComment($id);

		$comment->delete();

		return $this->redirect()
								->with(	'success',
												'Kommentar erfolgreich gelöscht');
	}

}
