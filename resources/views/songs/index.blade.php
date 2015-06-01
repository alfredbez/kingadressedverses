@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('sub.alerts')
			<div class="panel panel-default">
				<div class="panel-heading">{{ $listname or 'alle Lieder' }}</div>

				<div class="panel-body">
					@if (isset($filter))
						<a href="/{{ $filter }}/{{ $id }}/edit" class="btn btn-xs btn-primary">umbenennen</a>
						<form action="/{{ $filter }}/{{ $id }}" method="POST" class="one-btn-form">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_method" value="DELETE">
							<button class="btn btn-xs btn-danger">löschen</button>
						</form>
						<hr>
					@endif
					<ul class="list-group">
						@forelse($songs as $song)
							<li class="list-group-item">
								<a href="/song/{{ $song->id }}">{{ $song->title }}</a>
								<span class="badge visible-md-inline-block visible-lg-inline-block">{{ ($song->category->name) }}</span>
								<span class="badge visible-md-inline-block visible-lg-inline-block">Dateien: {{ count($song->files) }}</span>
							</li>
						@empty
							<p>{{ $errorNoSongs or 'Es gibt leider noch keine Lieder'}}</p>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
