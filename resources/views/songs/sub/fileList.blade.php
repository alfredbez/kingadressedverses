@if (count($files) > 0)
	<ul class="list-group">
	@foreach ($files as $file)
		<li class="list-group-item" data-id="{{ $file->id }}">
			<span class="label label-default">{{ $file->type }}</span>
			<a href="/file/{{ $file->id }}">{{ $file->name }}</a>
			@if (isset($editForm) && Auth::check())
				<span class="btn badge editFile" data-id="{{ $file->id }}">bearbeiten</span>
				<span class="btn btn-danger badge deleteFile" data-id="{{ $file->id }}">löschen</span>
			@endif
		</li>
	@endforeach
	</ul>
@else
	@if (!isset($editForm))
		Zu diesem Lied gibt es im Moment noch keine Dateien
	@endif
@endif
@if (Auth::check())
	<div style="display: none" id="fileEditForm" class="row">
		<div class="col-sm-12 col-md-8">
			<input type="text" id="fileEditName" class="form-control">
		</div>
		<div class="col-sm-12 col-md-4">
			<span class="btn btn-success" id="fileEditSubmit">Datei umbenennen</span>
		</div>
	</div>
@endif