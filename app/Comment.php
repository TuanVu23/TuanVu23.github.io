<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $primaryKey = 'cmt_id';
    protected $table = 'comment';
    public $timestamps = false;

    public function getUser(){
	    return $this->belongsto('App\User', 'user_id', 'user_id');
    }

    public function getMovie(){
        return $this->belongsto('App\Movie', 'movie_id', 'movie_id');
    }

    public function getDiffTime($timestamp){
    	Carbon::setLocale('vi');
    	$dt = Carbon::createFromTimestamp($timestamp, 'Asia/Ho_Chi_Minh');
    	$now = Carbon::now();
    	return $dt->diffForHumans($now);
    }
}
