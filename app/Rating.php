<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'rating_id';
    protected $table = 'rating';
    public $timestamps = false;
}
