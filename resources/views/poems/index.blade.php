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
					@include('poems.sub.list')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
