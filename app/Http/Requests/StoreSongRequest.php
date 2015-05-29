<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\LoggedInOnly;

class StoreSongRequest extends Request {

	use LoggedInOnly;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' 						=> 'required',
			'category_id' 			=> 'required',
			'composer_id' 			=> 'required',
			'orchestration_id' 	=> 'required',
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
			'category_id.required' => 'Wähle bitte eine passende Kategorie',
			'composer_id.required' => 'Gib bitte den Namen des Komponisten an',
			'orchestration_id.required' => 'Gib bitte die Besetzung an',
		];
	}

}
