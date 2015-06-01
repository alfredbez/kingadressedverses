<ul class="list-group">
	@forelse($songs as $song)
		<li class="list-group-item">
			<a href="/song/{{ $song->id }}">{{ $song->title }}</a>
			<span class="badge visible-md-inline-block visible-lg-inline-block">{{ ($song->category->name) }}</span>
			<span class="badge visible-md-inline-block visible-lg-inline-block">Dateien: {{ count($song->files) }}</span>
		</li>
	@empty
		<p>{{ $errorNoSongs or 'Es gibt leider noch keine Lieder'}}</p>
	@endforelse
</ul>