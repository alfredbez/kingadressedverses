<?php namespace App\Http\Requests;

trait LoggedInOnly {
	public function authorize()
	{
		// solange keine Anmelde-Funktion eingebaut ist, sollen alle
		// Request angenommen werden. Später sollen nur Requests von
		// angemeldeten Nutzern akzeptiert werden. Dazu einfach die
		// folgende Zeile entfernen
		return true;
		if(Auth::check())
		{
			return true;
		}
		return false;
	}
}