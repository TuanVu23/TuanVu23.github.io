<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review_content extends Model
{
    protected $primaryKey = 'revcon_id';
    protected $table = 'review_content';
    public $timestamps = false;
}
