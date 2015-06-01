@if(\Session::has('default'))
	<div class="alert alert-default alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!!  \Session::get('default') !!}
	</div>
@endif
@if(\Session::has('primary'))
	<div class="alert alert-primary alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!!  \Session::get('primary') !!}
	</div>
@endif
@if(\Session::has('info'))
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!!  \Session::get('info') !!}
	</div>
@endif
@if(\Session::has('success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!!  \Session::get('success') !!}
	</div>
@endif
@if(\Session::has('warning'))
	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!!  \Session::get('warning') !!}
	</div>
@endif
@if(\Session::has('danger'))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!!  \Session::get('danger') !!}
	</div>
@endif