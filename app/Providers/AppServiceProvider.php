<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.header', function($view){
            $genre1 = \DB::table('genre')->where('genre_id','<=',7)->get();
            $genre2 = \DB::table('genre')->where([['genre_id','>=',8], ['genre_id','<=', 14]])->get();
            $genre3 = \DB::table('genre')->where('genre_id','>=',15)->get();
            $slide = \DB::table('slide')->get();
            $view->with('genre1', $genre1)->with('genre2', $genre2)->with('genre3', $genre3)->with('slide', $slide);
        });
        view()->composer('layouts.top', function($view){
            $genre1 = \DB::table('genre')->where('genre_id','<=',7)->get();
            $genre2 = \DB::table('genre')->where([['genre_id','>=',8], ['genre_id','<=', 14]])->get();
            $genre3 = \DB::table('genre')->where('genre_id','>=',15)->get();
            $view->with('genre1', $genre1)->with('genre2', $genre2)->with('genre3', $genre3);
        });

        view()->composer('layouts.footer', function($view){
            $genres = \DB::table('genre')->take(13)->get();;
            $movies = \DB::table('movie')->where('type_id',1)->orderBy('release_date', 'desc')->take(6)->get();
            $reviews = \DB::table('review')->orderBy('time', 'desc')->take(4)->get();
            $view->with('genres', $genres)->with('movies', $movies)->with('reviews', $reviews);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
