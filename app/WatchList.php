<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    protected $primaryKey = 'watchlist_id';
    protected $table = 'watchlist';
    public $timestamps = false;
}
