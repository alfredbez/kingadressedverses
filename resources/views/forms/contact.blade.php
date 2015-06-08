@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @include('errors.form')
      @include('sub.alerts')
      <div class="panel panel-default">
        <div class="panel-heading">Kontakt</div>

        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="/contact">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {!! Honeypot::generate('real_name', 'real_time') !!}
            <div class="form-group">
              <label class="col-md-4 control-label">Name</label>
              <div class="col-md-6 @if ($errors->has('name')) has-error @endif">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <small class="error">{{ $errors->first('name') }}</small>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">E-Mail</label>
              <div class="col-md-6 @if ($errors->has('email')) has-error @endif">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <small class="error">{{ $errors->first('email') }}</small>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Nachricht</label>
              <div class="col-md-6 @if ($errors->has('message')) has-error @endif">
                <textarea name="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <small class="error">{{ $errors->first('message') }}</small>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">Senden</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
