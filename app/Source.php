<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
	protected $primaryKey = 'source_id';
    protected $table = "source";
    public $timestamps = false; 
}
