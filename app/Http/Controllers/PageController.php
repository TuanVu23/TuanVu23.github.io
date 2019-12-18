<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Movie;
use App\Watchlist;
use App\Comment;
use App\Rating;
use Session;

class PageController extends Controller
{
	// Cắt ngắn chuỗi ký tự (dùng cho đoạn văn)
	function cutString($string='',$size=100,$link='...')
	{
		$string = strip_tags(trim($string));
		$strlen = strlen($string);
		$str = substr($string,$size,20);
		$exp = explode(" ",$str);
		$sum =  count($exp);
		$yes= "";
		for($i=0;$i<$sum;$i++)
		{
			if($yes==""){
				$a = strlen($exp[$i]);
				if($a==0){ $yes="no"; $a=0;}
				if(($a>=1)&&($a<=12)){ $yes = "no"; $a;}
				if($a>12){ $yes = "no"; $a=12;}
			}
		}
		$sub = substr($string,0,$size+$a);
		if($strlen-$size>0){ $sub.= $link;}
		return $sub;
	}

    public function getIndex(){
    	//phim dang chieu
    	$latest = Movie::where('type_id', 1)->orderBy('release_date','desc')->get();

    	//phim moi
    	$recent = Movie::where('type_id', 1)->orderBy('release_date','desc')->take(9)->get();
    	unset($recent[0]);
    	//phim moi nhat
    	$new = $latest[0];
    	$date = date_create($new->release_date);
    	$new_date = date_format($date,"d/m/Y");
    	$new_desc = $new->description;
    	if(strlen($new_desc) > 230){
    		$new_desc = $this->cutString($new->description, 230);
    	}
    	$new_genres = \DB::table('movie_genre')->where('movie_id', $new->movie_id)->get();
    	$new_genre = array();
    	$i = 0;
    	foreach ($new_genres as $gen) {
    		$new_genre[$i] = \DB::table('genre')->where('genre_id', $gen->genre_id)->first();
    		$i++;
    	}
        $new_rated = \DB::table('rated')->where('rated_id', $new->rated_id)->first();

        //phim rating cao
        $rate = array();
        foreach ($latest as $film) {
            $movie_id = $film->movie_id;
            $rate[$movie_id] = $film->getRating($movie_id);          
        }
        arsort($rate);

        $i = 0;
        foreach ($rate as $key => $value) {
            $rates[$i] = Movie::find($key);
            $i++;
            if ($i == 9) break;
        }
        //phim rating cao nhat
        $top = $rates[0]; unset($rates[0]);
        $date = date_create($top->release_date);
        $top_date = date_format($date,"d/m/Y");
        $top_desc = $top->description;
        if(strlen($top_desc) > 230){
            $top_desc = $this->cutString($top_desc, 230);
        }
        $top_genres = \DB::table('movie_genre')->where('movie_id', $top->movie_id)->get();
        $top_genre = array();
        $i = 0;
        foreach ($top_genres as $gen) {
            $top_genre[$i] = \DB::table('genre')->where('genre_id', $gen->genre_id)->first();
            $i++;
        }
        $top_rated = \DB::table('rated')->where('rated_id', $top->rated_id)->first();

        //phim xem nhieu
        $views = Movie::where('type_id',1)->orderBy('view','desc')->take(9)->get();
        $view1 = $views[0]; unset($views[0]);
        $date = date_create($view1->release_date);
        $view1_date = date_format($date,"d/m/Y");
        $view1_desc = $view1->description;
        if(strlen($view1_desc) > 230){
            $view1_desc = $this->cutString($view1_desc, 230);
        }
        $view1_genres = \DB::table('movie_genre')->where('movie_id', $view1->movie_id)->get();
        $view1_genre = array();
        $i = 0;
        foreach ($view1_genres as $gen) {
            $view1_genre[$i] = \DB::table('genre')->where('genre_id', $gen->genre_id)->first();
            $i++;
        }
        $view1_rated = \DB::table('rated')->where('rated_id', $view1->rated_id)->first();

        //phim goi y
        $suggest = Movie::where('type_id',1)->orWhere('type_id',3)->orderBy('view','desc')->take(10)->get();

        //phim sap chieu
        $soons = Movie::where('type_id',3)->orderBy('release_date','asc')->take(9)->get();
        $soon1 = $soons[0]; unset($soons[0]);
        $date = date_create($soon1->release_date);
        $soon1_date = date_format($date,"d/m/Y");
        $soon1_desc = $soon1->description;
        if(strlen($soon1_desc) > 230){
            $soon1_desc = $this->cutString($soon1_desc, 230);
        }
        $soon1_genres = \DB::table('movie_genre')->where('movie_id', $soon1->movie_id)->get();
        $soon1_genre = array();
        $i = 0;
        foreach ($soon1_genres as $gen) {
            $soon1_genre[$i] = \DB::table('genre')->where('genre_id', $gen->genre_id)->first();
            $i++;
        }
        $soon1_rated = \DB::table('rated')->where('rated_id', $soon1->rated_id)->first();

    	return view('pages.index', compact('latest', 'recent', 'new', 'new_desc', 'new_date', 'new_genre', 'new_rated', 'rates', 'top', 'top_desc', 'top_date', 'top_genre', 'top_rated', 'suggest', 'soons', 'soon1', 'soon1_date', 'soon1_desc', 'soon1_genre', 'soon1_rated', 'views', 'view1', 'view1_date', 'view1_desc', 'view1_genre', 'view1_rated'));
    }

    public function getMovie($movie_id){
    	$movie = Movie::find($movie_id);
    	$director_id = \DB::table('movie_director')->where('movie_id', $movie_id)->get();
    	$director = array(); $di = 0;
    	foreach ($director_id as $id) {
    		$director[$di] = \DB::table('director')->where('director_id', $id->director_id)->first();
    		$di++;
    	}

    	$actor_id = \DB::table('movie_actor')->where('movie_id', $movie_id)->get();
    	$actor = array(); $ac = 0;
    	foreach ($actor_id as $id) {
    		$actor[$ac] = \DB::table('actor')->where('actor_id', $id->actor_id)->first();
    		$ac++;
    	}

    	$date = date_create($movie->release_date);
    	$release_date = date_format($date,"d/m/Y");

    	$genre_id = \DB::table('movie_genre')->where('movie_id', $movie_id)->get();
    	$genre = array(); $ge = 0;
    	foreach ($genre_id as $id) {
    		$genre[$ge] = \DB::table('genre')->where('genre_id', $id->genre_id)->first();
    		$ge++;
    	}

    	$rated = \DB::table('rated')->where('rated_id', $movie->rated_id)->first();

        //rating
        $rating = $movie->getRating($movie_id);
        $vote = 0;
        $ratings1 = Rating::where('movie_id', $movie_id)->get();
        $ratings2 = Comment::where('movie_id', $movie_id)->get();
        if(count($ratings1) != 0){            
            foreach ($ratings1 as $rati) {
                $vote = $vote + $rati->vote;
            }          
        }
        if(count($ratings2) != 0){
            $vote = $vote + count($ratings2);
        }       

        $reviews = Review::where('movie_id', $movie_id)->get();

        //check watchlist
        $like = -1;
        if(\Auth::user()){
            $user_id = \Auth::user()->user_id;
            $check = Watchlist::where([['user_id',$user_id],['movie_id',$movie_id]])->first();
            if(!empty($check)){
                $like = 1;
            }
            else{
                $like = 0;
            }
        }

        //views count
        $id = $movie_id;
        $name = 'movieinfo';
        $sessionKey = $name . '_' . $id;
        $sessionView = Session::get($sessionKey);
        if(!$sessionView)
        {
            // Gán giá trị session
            Session::put($sessionKey, 1);
            // Thực hiện cập nhật lượt xem, cộng dồn thêm 1
            $count = Movie::find($movie_id);
            Movie::where('movie_id', $movie_id)->update(['view' => $count->view+1]);
        }

        //show user-cmt
        $cmt = array('content' => '', 'rate' => 0, 'spoil' => 0);
        $cmt = (object) $cmt;
        $comment = 0;
        if(\Auth::user()){
            $user_id = \Auth::user()->user_id;
            $comment = Comment::where([['user_id', $user_id],['movie_id', $movie_id]])->first();
            if(!empty($comment)){
                $cmt = $comment;
            }
        }

        //show list cmt
        $comments = Comment::where('movie_id', $movie_id)->orderBy('time','desc')->get();

        //movie tab
        $movie_tab = Movie::where('type_id',1)->orderBy('release_date','desc')->take(2)->get();
        if($movie_tab[0]->movie_id == $movie_id){
            $tab = $movie_tab[1];
        }
        else{
            $tab = $movie_tab[0];
        }
        $tab_desc = $tab->description;
        if(strlen($tab_desc) > 160){
            $tab_desc = $this->cutString($tab_desc, 160);
        }
        $tab_genres = \DB::table('movie_genre')->where('movie_id', $tab->movie_id)->get();
        $ge = 0;
        foreach ($tab_genres as $id) {
            $tab_genre[$ge] = \DB::table('genre')->where('genre_id', $id->genre_id)->first();
            $ge++;
        }

        //link ticket
        $ticket = str_replace('phim', 'mua-ve', $movie->url);

    	return view('pages.movie', compact('movie', 'director', 'actor', 'release_date', 'genre', 'rated', 'reviews', 'like', 'rating', 'vote', 'cmt', 'comments' , 'comment', 'tab', 'tab_genre', 'tab_desc', 'ticket'));
    }

    public function getListReview(){
        $reviews = Review::orderBy('time','desc')->simplePaginate(8);
        $count = 0;
        $hot_review = Review::orderBy('view','desc')->take(6)->get();

        //movie_tab
        $movie = Movie::where('type_id',1)->orderBy('release_date','desc')->first();
        $movie_desc = $movie->description;
        if(strlen($movie_desc) > 160){
            $movie_desc = $this->cutString($movie_desc, 160);
        }
        $genres = \DB::table('movie_genre')->where('movie_id', $movie->movie_id)->get();
        $ge = 0;
        foreach ($genres as $id) {
            $genre[$ge] = \DB::table('genre')->where('genre_id', $id->genre_id)->first();
            $ge++;
        }
        return view('pages.reviews', compact('reviews', 'count', 'hot_review', 'movie', 'movie_desc', 'genre')); 
    }

    public function getReview($review_id){
        $review = Review::find($review_id);
        $recent = Review::where([['movie_id', $review->movie_id],['review_id', '<>', $review_id]])->get();
        $recent1 = Review::where([['source_id', $review->source_id],['review_id', '<>', $review_id]])->orderBy('time','desc')->take(5-count($recent))->get();

        //views count
        $id = $review_id;
        $name = 'reviewinfo';
        $sessionKey = $name . '_' . $id;
        $sessionView = Session::get($sessionKey);
        if(!$sessionView)
        {
            // Gán giá trị session
            Session::put($sessionKey, 1);
            // Thực hiện cập nhật lượt xem, cộng dồn thêm 1
            $count = Review::find($review_id);
            Review::where('review_id', $review_id)->update(['view' => $count->view+1]);
        }

        //movie this
        $mov = Movie::find($review->movie_id);
        $mov_desc = $mov->description;
        if(strlen($mov_desc) > 160){
            $mov_desc = $this->cutString($mov_desc, 160);
        }
        $genres = \DB::table('movie_genre')->where('movie_id', $review->movie_id)->get();
        $ge = 0;
        foreach ($genres as $id) {
            $gen[$ge] = \DB::table('genre')->where('genre_id', $id->genre_id)->first();
            $ge++;
        }

        //movie tab
        $movie = Movie::where('type_id',1)->orderBy('release_date','desc')->first();
        $movie_desc = $movie->description;
        if(strlen($movie_desc) > 160){
            $movie_desc = $this->cutString($movie_desc, 160);
        }
        $genres = \DB::table('movie_genre')->where('movie_id', $movie->movie_id)->get();
        $ge = 0;
        foreach ($genres as $id) {
            $genre[$ge] = \DB::table('genre')->where('genre_id', $id->genre_id)->first();
            $ge++;
        }

        //rating
        $rating = Rating::where([['movie_id', $review->movie_id], ['source_id', $review->source_id]])->first();

        return view('pages.review', compact('review', 'recent', 'recent1', 'movie', 'movie_desc', 'genre', 'mov', 'mov_desc', 'gen', 'rating'));
    }

    public function getGenre($genre_id){
        $name = \DB::table('genre')->where('genre_id', $genre_id)->first()->name;
        $desc = \DB::table('genre')->where('genre_id', $genre_id)->first()->description;
        $movie_id = \DB::table('movie_genre')->where('genre_id', $genre_id)->get();
        $i = 0;
        foreach ($movie_id as $id) {
            $movies[$i] = Movie::find($id->movie_id);
            $i++;
        }
        //paginate?
        return view('pages.genre', compact('movies', 'name', 'desc'));
    }

    public function getType($type_id){
        $month = date("m/Y");
        if ($type_id == 1) {
            $movies = Movie::where('type_id', $type_id)->orderBy('release_date','desc')->get();
        }
        elseif($type_id == 3) {
            $movies = Movie::where('type_id', $type_id)->orderBy('release_date','asc')->get();
        }
        else{
            $mov = Movie::orderBy('release_date','asc')->get();
            $i = 0;
            foreach ($mov as $mo) {
                $date = date_create($mo->release_date);
                $m = date_format($date,"m/Y");
                if ($m == $month) {
                    $movies[$i] = Movie::find($mo->movie_id);
                    $i++;
                }
            }
        }
        return view('pages.type', compact('movies', 'type_id', 'month'));
    }

    public function getActor($actor_id){
        $name = \DB::table('actor')->where('actor_id', $actor_id)->first()->name;
        $movie_id = \DB::table('movie_actor')->where('actor_id', $actor_id)->select('movie_id')->get();
        foreach ($movie_id as $id) {
            $movies[$id->movie_id] = Movie::find($id->movie_id);  
        }
        return view('pages.actor', compact('movies', 'name'));
    }

    public function getDirector($director_id){
        $name = \DB::table('director')->where('director_id', $director_id)->first()->name;
        $movie_id = \DB::table('movie_director')->where('director_id', $director_id)->select('movie_id')->get();
        foreach ($movie_id as $id) {
            $movies[$id->movie_id] = Movie::find($id->movie_id);  
        }
        return view('pages.director', compact('movies', 'name'));
    }
}
