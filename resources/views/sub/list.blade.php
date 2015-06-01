<ul class="list-group">
	@foreach($items as $item)
		<li class="list-group-item">
			<a href="/{{ $model }}/{{ $item->id }}">{{ $item->name }}</a>
		</li>
	@endforeach
</ul>