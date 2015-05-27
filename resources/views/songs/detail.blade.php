@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $song->title }}</div>

				<div class="panel-body">
					<table class="table">
						<tr>
							<th>Titel</th>
							<td>{{ $song->title }}</td>
						</tr>
						<tr>
							<th>Komponist</th>
							<td><a href="/composer/{{ $song->composer->id }}/">{{ $song->composer->name }}</a></td>
						</tr>
						<tr>
							<th>Kategorie</th>
							<td><a href="/category/{{ $song->category->id }}/">{{ $song->category->name }}</a></td>
						</tr>
						<tr>
							<th>Besetzung</th>
							<td><a href="/orchestration/{{ $song->orchestration->id }}/">{{ $song->orchestration->name }}</a></td>
						</tr>
						<tr>
							<th>Dateien</th>
							<td>
								@if (count($song->files) > 0)
									@foreach ($song->files as $file)
										<li>
											<span class="label label-default">{{ $file->type }}</span>
											<a href="/file/{{ $file->id }}">{{ $file->name }}</a>
										</li>
									@endforeach
								@else
									Zu diesem Lied gibt es im Moment noch keine Dateien
								@endif
							</td>
						</tr>
					</table>
					@if ($song->trashed())
						<form action="/song/{{ $song->id }}" method="POST">
							<input type="hidden" name="restore" value="true">
							<input type="hidden" name="_method" value="PUT">
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<button class="btn btn-success btn-sm">wiederherstellen</button>
						</form>
						<br>
						<form action="/song/{{ $song->id }}" method="POST">
							<input type="hidden" name="sure" value="true">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<button class="btn btn-danger btn-sm">endgültig entfernen</button>
						</form>
					@else
					<form action="/song/{{ $song->id }}" method="POST">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
						<button class="btn btn-danger btn-sm">löschen</button>
					</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
