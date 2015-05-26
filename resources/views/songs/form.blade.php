@extends('app')

@section('footerJs')
	<script src="/js/createSong.js"></script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $formtitle or 'neues Lied erstellen'}}</div>

				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/song') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Titel</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="{{ old('title') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Original-Titel</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="original_title" value="{{ old('original_title') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Kategorie</label>
							<div class="col-md-6">
								<select name="category">
									@forelse ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@empty
										<option value="0">keine Kategorien gefunden</option>
									@endforelse
								</select>
								<br>
								<input type="text" id="newCategoryName">
								<span class="btn btn-primary btn-xs" id="newCategory">Kategorie hinzufügen</span>
								<hr>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Komponist</label>
							<div class="col-md-6">
								<select name="composer">
									@forelse ($composers as $composer)
										<option value="{{ $composer->id }}">{{ $composer->name }}</option>
									@empty
										<option value="0">keine Komponsiten gefunden</option>
									@endforelse
								</select>
								<br>
								<input type="text" id="newComposerName">
								<span class="btn btn-primary btn-xs" id="newComposer">Komponist hinzufügen</span>
								<hr>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Besetzung</label>
							<div class="col-md-6">
								<select name="orchestration">
									@forelse ($orchestrations as $orchestration)
										<option value="{{ $orchestration->id }}">{{ $orchestration->name }}</option>
									@empty
										<option value="0">keine Besetzungen gefunden</option>
									@endforelse
								</select>
								<br>
								<input type="text" id="newOrchestrationName">
								<span class="btn btn-primary btn-xs" id="newOrchestration">Besetzung hinzufügen</span>
								<hr>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Dateien</label>
							<div class="col-md-6">
								<input type="files" name="files" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-success">Speichern</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
