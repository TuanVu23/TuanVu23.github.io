<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Pages
Route::get('index',[
	'as'=>'index',
	'uses'=>'PageController@getIndex'
]);
Route::get('movie/{movie_id}',[
	'as'=>'movie',
	'uses'=>'PageController@getMovie'
]);
Route::get('reviews',[
	'as'=>'reviews',
	'uses'=>'PageController@getListReview'
]);
Route::get('review/{review_id}',[
	'as'=>'review',
	'uses'=>'PageController@getReview'
]);
Route::get('genre/{genre_id}',[
	'as'=>'genre',
	'uses'=>'PageController@getGenre'
]);
Route::get('type/{type_id}',[
	'as'=>'type',
	'uses'=>'PageController@getType'
]);
Route::get('actor/{actor_id}',[
	'as'=>'actor',
	'uses'=>'PageController@getActor'
]);
Route::get('director/{director_id}',[
	'as'=>'director',
	'uses'=>'PageController@getDirector'
]);

//Auth
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

//Admin
Route::get('admin',[
	'as'=>'admin',
	'uses'=>'AdminController@getIndex'
]);
Route::get('admin/user_list',[
	'as'=>'user_list',
	'uses'=>'AdminController@getListUser'
]);
Route::get('admin/user_del/{user_id}',[
	'as'=>'user_del',
	'uses'=>'AdminController@delUser'
]);
Route::get('admin/user_add',[
	'as'=>'user_add',
	'uses'=>'AdminController@addUser'
]);
Route::post('admin/user_add/addtodb',[
	'as'=>'user_addtodb',
	'uses'=>'AdminController@register'
]);
Route::get('admin/review_list',[
	'as'=>'review_list',
	'uses'=>'AdminController@getListReview'
]);
Route::get('admin/review_del/{cmt_id}',[
	'as'=>'review_del',
	'uses'=>'AdminController@delReview'
]);
Route::get('admin/review_edit/{cmt_id}',[
	'as'=>'review_edit',
	'uses'=>'AdminController@editReview'
]);

//Watchlist
Route::get('watchlist',[
	'as'=>'watchlist',
	'uses'=>'WatchListController@getWatchList'
]);
Route::get('movie/addwatchlist/{movie_id}',[
	'as'=>'addwatchlist',
	'uses'=>'WatchListController@addMovie'
]);
Route::get('movie/delwatchlist/{movie_id}',[
	'as'=>'delwatchlist',
	'uses'=>'WatchListController@delMovie'
]);

//Account
Route::get('account',[
	'as'=>'account',
	'uses'=>'AccountController@getAccount'
]);
Route::post('account/updateinfo',[
	'as'=>'updateinfo',
	'uses'=>'AccountController@updateInfo'
]);
Route::post('account/changepass',[
	'as'=>'changepass',
	'uses'=>'AccountController@changePass'
]);
Route::post('account/updateavatar',[
	'as'=>'updateavatar',
	'uses'=>'AccountController@updateAvatar'
]);

//Search
Route::get('search',[
	'as'=>'search',
	'uses'=>'SearchController@showResult'
]);

//Comment (review)
Route::post('comment/{movie_id}',[
	'as'=>'comment',
	'uses'=>'CommentController@saveComment'
]);
Route::get('comment/delcmt/{cmt_id}',[
	'as'=>'delcmt',
	'uses'=>'CommentController@delComment'
]);