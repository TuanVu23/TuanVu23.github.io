<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rating;
use App\Comment;

class Movie extends Model
{
    protected $primaryKey = 'movie_id';
    protected $table = 'movie';
    public $timestamps = false;
    public function getReviews(){
    	return $this->hasMany('App\Review', 'movie_id', 'movie_id');
    }

    public function getRating($movie_id){
    	$rating = 0; $sum = 0; $vote = 0;
        $ratings1 = Rating::where('movie_id', $movie_id)->get();
        $ratings2 = Comment::where('movie_id', $movie_id)->get();
        if(count($ratings1) != 0){           
            foreach ($ratings1 as $rating) {
                $sum = $sum + $rating->vote * $rating->point;
                $vote = $vote + $rating->vote;
            }           
        }
        if(count($ratings2) != 0){
            foreach ($ratings2 as $rating) {
                $sum = $sum + $rating->rate;              
            }
            $vote = $vote + count($ratings2);
        }
        if($vote != 0){
            $rating = round($sum/$vote, 1);
        }
        return $rating;
    }
}
