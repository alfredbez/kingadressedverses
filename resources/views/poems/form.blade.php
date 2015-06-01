@extends('app')

@section('footerJs')
	<script src="/js/script.js"></script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('errors.form')
			<div class="panel panel-default">
				<div class="panel-heading">{{ $formtitle or 'neues Gedicht erstellen'}}</div>

				<div class="panel-body">
						@if ($data != null)
							<form class="form-horizontal" role="form" method="POST" action="/poem/{{ $data->id }}" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PUT">
						@else
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/poem') }}" enctype="multipart/form-data">
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
						<hr>
						<div class="form-group">
							<label class="col-md-4 control-label">Autor</label>
							<div class="col-md-6 @if ($errors->has('category')) has-error @endif">
								<select name="author_id" class="form-control">
									@forelse ($authors as $author)
										<option value="{{ $author->id }}"
											@if ($data != null && $author->id == $data->author->id) selected="selected" @endif
										>{{ $author->name }}</option>
									@empty
										<option value="0">keinen Autor gefunden</option>
									@endforelse
								</select>
								@if ($errors->has('author'))
								    <small class="error">{{ $errors->first('author') }}</small>
								@endif
								<br>
								<div class="row">
									<div class="col-sm-12 col-md-8">
										<input type="text" id="newAuthorName" placeholder="Name des neuen Autors" class="form-control input-sm">
									</div>
									<div class="col-sm-12 col-md-4">
										<span class="btn btn-primary btn-sm" id="newAuthor">Autor hinzufügen</span>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<label class="col-md-4 control-label">Thema</label>
							<div class="col-md-6 @if ($errors->has('topic')) has-error @endif">
								<select name="topic_id" class="form-control">
									@forelse ($topics as $topic)
										<option value="{{ $topic->id }}"
											@if ($data != null && $topic->id == $data->topic->id) selected="selected" @endif
											@if ($topic->id == old('topic')) selected="selected" @endif
										>{{ $topic->name }}</option>
									@empty
										<option value="0">keine Themen gefunden</option>
									@endforelse
								</select>
								@if ($errors->has('topic'))
								    <small class="error">{{ $errors->first('topic') }}</small>
								@endif
								<br>
								<div class="row">
									<div class="col-sm-12 col-md-8">
										<input type="text" id="newTopicName" placeholder="Name des neuen Themas" class="form-control input-sm">
									</div>
									<div class="col-sm-12 col-md-4">
										<span class="btn btn-primary btn-sm" id="newTopic">Thema hinzufügen</span>
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
									@include('sub.fileList', ['files' => $data->files, 'editForm' => true])
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
