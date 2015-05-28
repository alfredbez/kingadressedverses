@if (count($files) > 0)
	<ul class="list-group">
	@foreach ($files as $file)
		<li class="list-group-item" data-id="{{ $file->id }}">
			<span class="label label-default">{{ $file->type }}</span>
			<a href="/file/{{ $file->id }}">{{ $file->name }}</a>
			@if (isset($editForm))
				<span class="btn badge editFile" data-id="{{ $file->id }}">bearbeiten</span>
			@endif
		</li>
	@endforeach
	</ul>
@else
	@if (!isset($editForm))
		Zu diesem Lied gibt es im Moment noch keine Dateien
	@endif
@endif
<div style="display: none" id="fileEditForm" class="row">
	<div class="col-sm-12 col-md-8">
		<input type="text" id="fileEditName" class="form-control">
	</div>
	<div class="col-sm-12 col-md-4">
		<span class="btn btn-success" id="fileEditSubmit">Datei umbenennen</span>
	</div>
</div>