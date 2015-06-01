<ul class="list-group">
	@forelse($poems as $poem)
		<li class="list-group-item">
			<a href="/poem/{{ $poem->id }}">{{ $poem->title }}</a>
			<span class="badge visible-md-inline-block visible-lg-inline-block">{{ ($poem->topic->name) }}</span>
			<span class="badge visible-md-inline-block visible-lg-inline-block">Dateien: {{ count($poem->files) }}</span>
		</li>
	@empty
		<p>{{ $errorNoPoems or 'Es gibt leider noch keine Gedichte'}}</p>
	@endforelse
</ul>