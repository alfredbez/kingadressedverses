<div class="panel panel-default">
  <div class="panel-heading">Kommentare</div>
  <div class="panel-body">
    <p><button class="btn btn-primary btn-xs" type="button" data-toggle="collapse" data-target="#commentForm" aria-expanded="false" aria-controls="commentForm">Kommentar hinzufügen</button></p>
    <div class="collapse @if (count($errors) > 0) in @endif" id="commentForm">
      <form method="POST" action="{{ $url }}/comment">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group @if ($errors->has('author')) has-error @endif">
          <label for="author">Name</label>
          <input value="{{ old('author') }}" type="text" class="form-control" id="author" name="author" placeholder="Dein Name">
          @if ($errors->has('author'))
              <small class="error">{{ $errors->first('author') }}</small>
          @endif
        </div>
        <div class="form-group">
          <label for="email">E-Mail Adresse</label>
          <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group @if ($errors->has('comment')) has-error @endif">
          <label for="comment">Kommentar</label>
          <textarea class="form-control" rows="3" name="comment" id="comment">{{ old('comment') }}</textarea>
          @if ($errors->has('comment'))
              <small class="error">{{ $errors->first('comment') }}</small>
          @endif
        </div>
        <button type="submit" class="btn btn-success">Speichern</button>
      </form>
      <hr>
    </div>
    @forelse ($comments as $comment)
      <div class="panel panel-default">
        <div class="panel-heading">
          @unless ($comment->published)
            <span class="label label-info">nicht öffentlich</span>
          @endunless
          @if ($comment->email != "")
            <a href="mailto:{{ $comment->email }}">{{ $comment->author }}</a>
          @else
            {{ $comment->author }}
          @endif
          schrieb am {{ date("d.m.Y",strtotime($comment->created_at)) }}
          um {{ date("H:i",strtotime($comment->created_at)) }} Uhr
        </div>
        <div class="panel-body">
          {{ $comment->comment }}
        </div>
        @if (Auth::check())
          <div class="panel-footer">
            @unless ($comment->published)
              <a class="btn btn-xs btn-success" href="/comment/{{ $comment->id }}/publish">diesen Kommentar veröffentlichen</a>
            @endunless
            <a class="btn btn-xs btn-danger" href="/comment/{{ $comment->id }}/delete">diesen Kommentar löschen</a>
          </div>
        @endif
      </div>
    @empty
      Zu diesem {{ $type }} gibt es noch keine Kommentare
    @endforelse
  </div>
</div>