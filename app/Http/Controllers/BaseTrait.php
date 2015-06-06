<?php namespace App\Http\Controllers;

use Auth;

trait BaseTrait {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($request)
    {
        if(Auth::check())
        {
            $modelName = 'App\\' . ucwords($this->itemName);
            $item = $modelName::create($request->all());
            $this->uploadFiles($request, $item->id);
            return redirect($this->itemName);
        }
        else
        {
            return redirect($this->itemName);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, $request)
    {
        if(Auth::check())
        {
            $old = $this->item->find($id);
            $new = $request->all();
            $old->update($new);
            $this->uploadFiles($request, $id);
            return redirect()->route( $this->itemName . '.show', [$old]);
        }
        else
        {
            return redirect( $this->itemName );
        }
    }
}