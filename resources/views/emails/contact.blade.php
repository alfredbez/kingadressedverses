Du hast eine neue Nachricht von <b><a href="mailto:{{ $data['email'] }}">{{ $data['name'] }}</a></b> über das Kontaktformular erhalten:
<hr>
{{ $data['message'] }}
<hr>
<br><br>
{{ $data['name'] }} hat folgende E-Mail Adresse angegeben: {{ $data['email'] }}