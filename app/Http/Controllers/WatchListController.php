<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watchlist;
use App\User;
use App\Movie;

class WatchListController extends Controller
{
    public function getWatchList(){
        if (\Auth::user()) {
            $user_id = \Auth::user()->user_id;
            $list = User::find($user_id)->watchList;
            $j = 0;
            foreach ($list as $li) {
                $list_id[$j] = $li->movie_id;
                $j++;
            }
            if(count($list) != 0){
                $genre = \DB::table('movie_genre')->where('movie_id', $list[0]->movie_id)->get();
                $movie_id = \DB::table('movie_genre')->where('genre_id', $genre[0]->genre_id)->whereNotIn('movie_id', $list_id)->take(10)->get();
                $i = 0;
                foreach ($movie_id as $id) {
                    $suggest[$i] = Movie::find($id->movie_id);
                    $i++;
                }
                if(count($suggest) < 10 && count($genre) > 1){
                    $movie_id = \DB::table('movie_genre')->where('genre_id', $genre[1]->genre_id)->whereNotIn('movie_id', $list_id)->take(10)->take(11-count($suggest))->get();
                    foreach ($movie_id as $id) {
                        $suggest[$i] = Movie::find($id->movie_id);
                        $i++;
                    }
                }
                $suggest = array_unique($suggest);
            }
            else{
                $suggest = Movie::where('type_id','<>','2')->orderBy('view','desc')->take(10)->get();
            }
            return view('pages.watchlist', compact('list', 'suggest'));
        }
        abort(403, 'Access denied! You don’t have permission to access / on this server.');
    }

    public function addMovie($movie_id){
    	$user_id = \Auth::user()->user_id;
        Watchlist::insert(['user_id'=>$user_id, 'movie_id'=>$movie_id]);
        return redirect()->back()->with('alert', 'Đã thêm vào tủ phim của bạn');
    }

    public function delMovie($movie_id){
    	$user_id = \Auth::user()->user_id;
        Watchlist::where([['user_id',$user_id], ['movie_id',$movie_id]])->delete();
        return redirect()->back()->with('alert','Đã xóa khỏi tủ phim của bạn');
    }
}
