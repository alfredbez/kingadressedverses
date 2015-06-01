@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('sub.alerts')
			<h1>Suchergebnisse</h1>

			{{-- Lieder --}}
			<div class="panel panel-default">
				<div class="panel-heading">Lieder</div>
				<div class="panel-body">
					@if (count($results['songs']) > 0)
						@include('songs.sub.list', ['songs' => $results['songs']])
					@else
						Es wurden keine Lieder zu diesem Suchbegriff gefunden
					@endif
				</div>
			</div>

			{{-- Gedichte --}}
			<div class="panel panel-default">
				<div class="panel-heading">Gedichte</div>
				<div class="panel-body">
					@if (count($results['poems']) > 0)
						@include('poems.sub.list', ['poems' => $results['poems']])
					@else
						Es wurden keine Gedichte zu diesem Suchbegriff gefunden
					@endif
				</div>
			</div>

			{{-- Kategorien --}}
			@if (count($results['categories']) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">Kategorien</div>
					<div class="panel-body">
						@include('sub.list', ['items' => $results['categories'], 'model' => 'category'])
					</div>
				</div>
			@endif

			{{-- Komponisten --}}
			@if (count($results['composers']) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">Komponisten</div>
					<div class="panel-body">
						@include('sub.list', ['items' => $results['composers'], 'model' => 'composer'])
					</div>
				</div>
			@endif

			{{-- Besetzungen --}}
			@if (count($results['orchestrations']) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">Besetzungen</div>
					<div class="panel-body">
						@include('sub.list', ['items' => $results['orchestrations'], 'model' => 'orchestration'])
					</div>
				</div>
			@endif

			{{-- Autoren --}}
			@if (count($results['authors']) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">Autoren</div>
					<div class="panel-body">
						@include('sub.list', ['items' => $results['authors'], 'model' => 'author'])
					</div>
				</div>
			@endif

			{{-- Themen --}}
			@if (count($results['topics']) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">Themen</div>
					<div class="panel-body">
						@include('sub.list', ['items' => $results['topics'], 'model' => 'topic'])
					</div>
				</div>
			@endif

		</div>
	</div>
</div>
@endsection
