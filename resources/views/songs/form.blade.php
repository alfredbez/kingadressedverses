@extends('app')

@section('footerJs')
	<script src="/js/songForm.js"></script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Ups!</strong> Es gabe einige Probleme bei der Eingabe.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">{{ $formtitle or 'neues Lied erstellen'}}</div>

				<div class="panel-body">
						@if ($data != null)
							<form class="form-horizontal" role="form" method="POST" action="/song/{{ $data->id }}" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PUT">
						@else
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/song') }}" enctype="multipart/form-data">
						@endif
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Titel</label>
							<div class="col-md-6 @if ($errors->has('title')) has-error @endif">
								<input type="text" class="form-control" name="title" value="{{ $data->title or old('title') }}">
								@if ($errors->has('title'))
								    <small class="error">{{ $errors->first('title') }}</small>
								@endif
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Original-Titel</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="original_title" value="{{ $data->original_title or old('original_title') }}">
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-md-4 control-label">Kategorie</label>
							<div class="col-md-6 @if ($errors->has('category')) has-error @endif">
								<select name="category_id" class="form-control">
									@forelse ($categories as $category)
										<option value="{{ $category->id }}"
											@if ($data != null && $category->id == $data->category->id) selected="selected" @endif
										>{{ $category->name }}</option>
									@empty
										<option value="0">keine Kategorien gefunden</option>
									@endforelse
								</select>
								@if ($errors->has('category'))
								    <small class="error">{{ $errors->first('category') }}</small>
								@endif
								<br>
								<div class="row">
									<div class="col-sm-12 col-md-8">
										<input type="text" id="newCategoryName" class="form-control input-sm">
									</div>
									<div class="col-sm-12 col-md-4">
										<span class="btn btn-primary btn-sm" id="newCategory">Kategorie hinzufügen</span>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-md-4 control-label">Komponist</label>
							<div class="col-md-6 @if ($errors->has('composer')) has-error @endif">
								<select name="composer_id" class="form-control">
									@forelse ($composers as $composer)
										<option value="{{ $composer->id }}"
											@if ($data != null && $composer->id == $data->composer->id) selected="selected" @endif
											@if ($composer->id == old('composer')) selected="selected" @endif
										>{{ $composer->name }}</option>
									@empty
										<option value="0">keine Komponsiten gefunden</option>
									@endforelse
								</select>
								@if ($errors->has('composer'))
								    <small class="error">{{ $errors->first('composer') }}</small>
								@endif
								<br>
								<div class="row">
									<div class="col-sm-12 col-md-8">
										<input type="text" id="newComposerName" class="form-control input-sm">
									</div>
									<div class="col-sm-12 col-md-4">
										<span class="btn btn-primary btn-sm" id="newComposer">Komponist hinzufügen</span>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-md-4 control-label">Besetzung</label>
							<div class="col-md-6 @if ($errors->has('orchestration')) has-error @endif">
								<select name="orchestration_id" class="form-control">
									@forelse ($orchestrations as $orchestration)
										<option value="{{ $orchestration->id }}"
											@if ($data != null && $orchestration->id == $data->orchestration->id) selected="selected" @endif
										>{{ $orchestration->name }}</option>
									@empty
										<option value="0">keine Besetzungen gefunden</option>
									@endforelse
								</select>
								@if ($errors->has('orchestration'))
								    <small class="error">{{ $errors->first('orchestration') }}</small>
								@endif
								<br>
								<div class="row">
									<div class="col-sm-12 col-md-8">
										<input type="text" id="newOrchestrationName" class="form-control input-sm">
									</div>
									<div class="col-sm-12 col-md-4">
										<span class="btn btn-primary btn-sm" id="newOrchestration">Besetzung hinzufügen</span>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-md-4 control-label">Dateien</label>
							<div class="col-md-6">
								<input type="file" name="files[]" multiple="multiple" />
								<br>
								@if ($data != null)
									@include('songs.sub.fileList', ['files' => $data->files, 'editForm' => true])
								@endif
							</div>
						</div>
						<hr>
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
