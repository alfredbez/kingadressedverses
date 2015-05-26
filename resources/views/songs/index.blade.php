@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $listname or 'alle Lieder' }}</div>

				<div class="panel-body">
					<ul>
						@forelse($songs as $song)
							<li><a href="/song/{{ $song->id }}">{{ $song->title }}</a></li>
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
