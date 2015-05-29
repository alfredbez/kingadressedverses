<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Http\Requests\LoggedInOnly;

class StoreOrchestrationRequest extends Request {

	use LoggedInOnly;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required',
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
			'required' => 'Bitte gib die Bezeichnung der Besetzung an',
		];
	}

}
