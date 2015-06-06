<?php namespace App\Http\Controllers;

trait HasItem {

    /* enthält das Object, also z.B. new Song() */
    protected $item;

    /* enthält den Namen des Object, also z.B. 'song' */
    protected $itemName;

    /* enthält den Namen des Objects für die Templates, also z.B. 'Lied' */
    protected $itemDisplayName;

    /* wie $itemDisplayName nur Plural, also z.B. 'Lieder' */
    protected $itemDisplayNamePlural;

}