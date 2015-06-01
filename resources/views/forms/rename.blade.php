@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@include('errors.form')
			<div class="panel panel-default">
				<div class="panel-heading"><i>{{ $data->name }}</i> umbenennen</div>

				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="/{{ $model }}/{{ $data->id }}" enctype="multipart/form-data">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6 @if ($errors->has('name')) has-error @endif">
								<input type="text" class="form-control" name="name" value="{{ $data->name or old('name') }}">
								@if ($errors->has('name'))
								    <small class="error">{{ $errors->first('name') }}</small>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-success">Umbenennen</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
