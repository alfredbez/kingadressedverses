<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseTrait;

use Illuminate\Http\Request;

use App\File;
use App\Comment;

use Storage;
use Auth;
use Mail;

class ItemController extends Controller {

  /* enthält das Object, also z.B. new Song() */
  protected $item;

  /* enthält den Namen des Object, also z.B. 'song' */
  protected $itemName;

  /* enthält den Namen des Objects für die Templates, also z.B. 'Lied' */
  protected $itemDisplayName;

  /* wie $itemDisplayName nur Plural, also z.B. 'Lieder' */
  protected $itemDisplayNamePlural;

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view(
      $this->itemName . 's.index',
      [ $this->itemName . 's' => $this->item->ordered() ]
    );
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    if(Auth::check())
    {
      return view( $this->itemName . 's.form', ['data' => []]);
    }
    else
    {
      return redirect( $this->itemName );
    }
  }

  protected function uploadFiles($request, $itemId)
  {
    /* Dateien hochladen und speichern */
    if($request->hasFile('files'))
    {
      foreach($request->file('files') as $uploadedFile)
      {
        $file = new File();

        /* App\File@setNameAttribute */
        $file->name = $uploadedFile->getClientOriginalName();

        $file->type = $uploadedFile->guessClientExtension();

        $idAttribute = $this->itemName . '_id';

        $file->{$idAttribute} = $itemId;

        $file->save();

        /* App\File@getFilenameAttribute */
        $filename = $file->filename;

        Storage::disk('local')->put($file->filename, \Illuminate\Support\Facades\File::get($uploadedFile));
      }
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $items = $this->item->withTrashed()->where('id', $id)->first();
    if(Auth::check())
    {
      $comments = $items->comments;
    }
    else{
      $comments = $items->comments()->published()->get();
    }
    return view( $this->itemName . 's.detail', [
      $this->itemName => $items,
      'comments' => $comments,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    if(Auth::check())
    {
      $item = $this->item->find($id);
      return view( $this->itemName . 's.form', [
          'data'      => $item,
          'formtitle' => $this->itemDisplayName . ' "' . $item->title . '" bearbeiten',
        ]);
    }
    else
    {
      return redirect( $this->itemName );
    }
  }

  public function storeComment($id, StoreCommentRequest $request)
  {
    $this->item->find($id)->comments()->create( $request->all() );

    $commentId = Comment::orderBy('id', 'desc')->first()->id;

    $commentLink = '/' . $this->itemName . '/' . $id . '/#comment' . $commentId;

    Mail::queue(
      'emails.newComment', compact('commentLink'), function ($m) {
        $m->to('alfred.bez@gmail.com', 'Alfred Bez')
          ->subject('Es gibt einen neuen Kommentar');
      }
    );

    return redirect()->route($this->itemName . '.show' , ['id' => $id])
                      ->with( 'info',
                              'Der Kommentar wurde erfolgreich gespeichert, '
                              . 'muss aber noch vom Administrator '
                              . 'veröffentlich werden.');
  }

  public function restore($id, Request $request)
  {
    if(Auth::check())
    {
      if($request->has('restore'))
      {
        $this->item->withTrashed()->where('id', $id)->first()->restore();
        return redirect( $this->itemName );
      }
    }
    else
    {
      return redirect( $this->itemName );
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id, Request $request)
  {
    if(Auth::check())
    {
      if($request->has('sure'))
      {
        // Verknüpfungen zu Dateien aufheben
        $trashed = $this->item->withTrashed()->where('id', $id)->first();
        $idAttribute = $this->itemName . '_id';
        foreach($trashed->files as $file)
        {
          $file->{$idAttribute} = null;
          $file->save();
        }
        $trashed->forceDelete();
        return redirect( $this->itemName );
      }
      $this->item->find($id)->delete();
      return redirect( $this->itemName );
    }
    else
    {
      return redirect( $this->itemName );
    }
  }

  public function trash()
  {
    if(Auth::check())
    {
      $itemKey = $this->itemName . 's';
      $errorKey = 'errorNo' . ucwords( $this->itemName ) . 's';
      return view( $this->itemName . 's.index', [
        $itemKey    => $this->item->onlyTrashed()->get(),
        'listname'  => 'Alle gelöschten ' . $this->itemDisplayNamePlural,
        $errorKey   => 'Es gibt keine gelöschten ' . $this->itemDisplayNamePlural,
        ]);
    }
    else
    {
      return redirect( $this->itemName );
    }
  }

}
