<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Song;
use App\Poem;
use App\Category;
use App\Composer;
use App\Orchestration;
use App\Topic;
use App\Author;

use Illuminate\Http\Request;

class SearchController extends Controller {

	private $searchWord;

	public function test()
	{
		dd('hello');
	}

	public function run(Request $request)
	{
		$this->searchWord = trim($request->searchWord);
		/* Lieder suchen */
		$songs = $this->search(new Song, ['title', 'original_title']);
		/* Gedichte suchen */
		$poems = $this->search(new Poem, ['title']);
		/* Kategoriename suchen */
		$categories = $this->search(new Category);
		/* Komponisten suchen */
		$composers = $this->search(new Composer);
		/* Besetzungen suchen */
		$orchestrations = $this->search(new Orchestration);
		/* Autoren suchen */
		$authors = $this->search(new Author);
		/* Themen suchen */
		$topics = $this->search(new Topic);
		$data = compact(
				'songs',
				'poems',
				'categories',
				'composers',
				'orchestrations',
				'authors',
				'topics'
			);
		return view('search.results', ['results' => $data]);
	}

	private function search($model, $fields = ['name'])
	{
		$query = $model->where($fields[0], 'like', '%' . $this->searchWord . '%');
		if(count($fields) > 1)
		{
			for($i = 1; count($fields) < $i; $i++)
			{
				$query = $query->orWhere($fields[$i], 'like', '%' . $this->searchWord . '%');
			}
		}
		return $query->take(10)->get();
	}

}
