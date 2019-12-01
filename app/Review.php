<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $primaryKey = 'review_id';
    protected $table = 'review';
    public $timestamps = false;
    public function getSource(){
    	return $this->belongsTo('App\Source','source_id','source_id');
    }
    public function getContent(){
    	return $this->hasMany('App\Review_content','review_id','review_id');
    }
}
