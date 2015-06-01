@if (isset($filter) && Auth::check())
	<a href="/{{ $filter }}/{{ $id }}/edit" class="btn btn-xs btn-primary">umbenennen</a>
	<form action="/{{ $filter }}/{{ $id }}" method="POST" class="one-btn-form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="DELETE">
		<button class="btn btn-xs btn-danger">löschen</button>
	</form>
	<hr>
@endif