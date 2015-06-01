<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\LoggedInOnly;

class StorePoemRequest extends Request {

	use LoggedInOnly;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required',
			'author_id' => 'required',
			'topic_id' => 'required',
		];
	}

	/**
	 * Set custom messages for validator errors.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'author_id.required' => 'Wähle bitte einen Author aus',
			'topic_id.required' => 'Wähle bitte das entsprechende Thema aus',
		];
	}

}
