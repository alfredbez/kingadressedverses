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
								@forelse ($song->files as $file)
									<a href="#">{{ $file->name }}</a>
								@empty
									Zu diesem Lied gibt es im Moment noch keine Dateien
								@endforelse
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
