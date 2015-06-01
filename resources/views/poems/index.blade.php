@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('sub.alerts')
			<div class="panel panel-default">
				<div class="panel-heading">{{ $listname or 'alle Gedichte' }}</div>

				<div class="panel-body">
					@include('sub.edit')
					<ul class="list-group">
						@forelse($poems as $poem)
							<li class="list-group-item">
								<a href="/poem/{{ $poem->id }}">{{ $poem->title }}</a>
								<span class="badge visible-md-inline-block visible-lg-inline-block">{{ ($poem->topic->name) }}</span>
								<span class="badge visible-md-inline-block visible-lg-inline-block">Dateien: {{ count($poem->files) }}</span>
							</li>
						@empty
							<p>{{ $errorNoPoems or 'Es gibt leider noch keine Gedichte'}}</p>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
