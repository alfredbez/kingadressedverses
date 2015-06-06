<?php namespace App\Http\Controllers;

use Auth;

trait SimpleBaseTrait {

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
            $item = new $modelName();
            $item->name = $request->input('name');
            return json_encode([
                    'saved' => $item->save(),
                    'name' => $item->name
                ]);
        }
        else
        {
            return \App::abort(403, 'Access denied');
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
            $oldname = $old->name;
            $new = $request->all();
            $old->update($new);
            return redirect()
                    ->route( $this->itemName . '.show', ['id' => $id])
                    ->with('success', $this->itemDisplayName
                                        . ' <i>' . $oldname . '</i>'
                                        . ' erfolgreich umbenannt');
        }
        else
        {
            return \App::abort(403, 'Access denied');
        }
    }
}