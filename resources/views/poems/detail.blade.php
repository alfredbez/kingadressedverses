@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $poem->title }}</div>

				<div class="panel-body">
					<table class="table">
						<tr>
							<th>Titel</th>
							<td>{{ $poem->title }}</td>
						</tr>
						<tr>
							<th>Autor</th>
							<td><a href="/author/{{ $poem->author->id }}/">{{ $poem->author->name }}</a></td>
						</tr>
						<tr>
							<th>Thema</th>
							<td><a href="/topic/{{ $poem->topic->id }}/">{{ $poem->topic->name }}</a></td>
						</tr>
						<tr>
							<th>Dateien</th>
							<td>
								@include('sub.fileList', ['files' => $poem->files])
							</td>
						</tr>
					</table>
					@if (Auth::check())
						@if ($poem->trashed())
							<form action="/poem/{{ $poem->id }}/restore" method="POST">
								<input type="hidden" name="restore" value="true">
								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
								<button class="btn btn-success btn-sm">wiederherstellen</button>
							</form>
							<br>
							<form action="/poem/{{ $poem->id }}" method="POST">
								<input type="hidden" name="sure" value="true">
								<input type="hidden" name="_method" value="DELETE">
								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
								<button class="btn btn-danger btn-sm">endgültig entfernen</button>
							</form>
						@else
						<a href="/poem/{{ $poem->id }}/edit" class="btn btn-primary btn-sm">bearbeiten</a>
						<br><br>
						<form action="/poem/{{ $poem->id }}" method="POST">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<button class="btn btn-danger btn-sm">löschen</button>
						</form>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
