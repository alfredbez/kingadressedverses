<?php namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;

use Mail;

class ContactController extends Controller {

	public function form()
  {
    return view('forms.contact');
  }

  public function send(ContactRequest $request)
  {
    Mail::queue(
      'emails.contact', ['data' => $request->all()], function ($m) {
        $m->to('bettina.hipke@gmail.com', 'Bettina Hipke')
          ->subject('Neue Nachricht über das Kontaktformular');
      }
    );
    return redirect()->back()->with('success', 'Nachricht erfolgreich gesendet');
  }

}
