<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function saveComment(Request $rq, $movie_id){
    	$rate = $rq->stars;
    	$content = $rq->review;
    	$spoil = 0;
    	if ($rq->checkbox == 'on'){
    		$spoil = 1;
    	}
    	$user_id = \Auth::user()->user_id;
    	$time = now();

    	$sql = Comment::where([['user_id', $user_id],['movie_id', $movie_id]])->first();
		if (empty($sql)) {
    		Comment::insert(['movie_id'=>$movie_id, 'user_id'=>$user_id, 'content'=>$content, 'rate'=>$rate, 'spoil'=>$spoil, 'time'=>$time]);
    	}
    	else {
    		Comment::where([['user_id', $user_id],['movie_id', $movie_id]])->update(['content'=>$content, 'rate'=>$rate, 'spoil'=>$spoil, 'time'=>$time]);
    	}
    	return redirect()->back()->with('alert', 'Cảm ơn bạn đã review về bộ phim này');
    }

    public function delComment($cmt_id){
    	Comment::where('cmt_id', $cmt_id)->delete();
    	return redirect()->back()->with('alert', 'Đã xóa review của bạn');
    }
}
