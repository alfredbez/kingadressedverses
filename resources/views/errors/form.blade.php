<div id="formAlert" class="alert alert-danger @if (count($errors) == 0) hidden @endif">
	<strong>Ups!</strong> Es gab einige Probleme bei der Eingabe.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>