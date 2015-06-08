<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreCommentRequest extends Request {

	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'author' 			=> 'required',
			'comment' 		=> 'required',
			'real_name'   => 'honeypot',
			'real_time'   => 'required|honeytime:5',
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
			'author.required' => 'Bitte gib deinen Namen an',
		];
	}

}
