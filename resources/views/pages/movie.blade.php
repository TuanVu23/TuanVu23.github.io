@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li><a href="#">Movies</a><i>//</i></li>
			<li>Single</li>
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<!--/content-inner-section-->
<div class="w3_content_agilleinfo_inner">
	<div class="agile_featured_movies">
		<div class="latest-news-agile-info">
			<div class="col-md-8 latest-news-agile-left-content">
				@if (Session::has('alert'))	
				    <div id="showalert" style="text-align: center; margin-top: -40px;" class="alert alert-success alert-dismissible">
				    	<button id="closealert" class="close" aria-label="close" title="Đóng">&times;</button>
				    	{{ Session::get('alert') }}  
				    </div>
				    <?php Session::forget('alert'); ?>
				@endif
				<div class="inner-agile-w3l-part-head">
					<h3 class="w3l-inner-h-title">{{$movie->name_vi}}</h3>
					<p style="color: #fe423f;" class="w3ls_head_para">{{$movie->name_en}}</p>
				</div>
				<div class="row">
					<div class="col-md-4">
						<img style="border: 1px solid #02a388; margin-left: auto; margin-right: auto; border-radius: .375rem;" src="{{$movie->poster}}" class="img-responsive" alt="{{$movie->poster}}" />
					<div style="text-align: center; margin: .7em 0;" class="single-agile-shar-buttons">
						<ul>
							<li>
								<div class="fb-like" data-href="{{URL::current()}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
								<script>(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
								js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
								fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
							</li>
							<li>
								<!-- Place this tag where you want the +1 button to render. -->
								<div class="g-plusone" data-size="medium"></div>
								<!-- Place this tag after the last +1 button tag. -->
								<script type="text/javascript">
								(function() {
									var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
									po.src = 'https://apis.google.com/js/platform.js';
									var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								})();
								</script>
							</li>
						</ul>
					</div>
					</div>
					<div class="col-md-8">
						<p style="margin-top: 0" class="fexi_header_para">
							<span style="height: 22px;">Đạo diễn<label>:</label></span>
							@if(!empty($director))
								@foreach($director as $dir)
								<strong><a href="{{route('director',$dir->director_id)}}">{{$dir->name}}</a></strong><b>, </b>
								@endforeach
							@else
								<strong>Đang cập nhật</strong>
							@endif
						</p>
						<p class="fexi_header_para">
							<span style="height: 22px;">Diễn viên<label>:</label></span>
							@if(!empty($actor))
								@foreach($actor as $act)
								<strong><a href="{{route('actor',$act->actor_id)}}">{{$act->name}}</a></strong><b>, </b>
								@endforeach
							@else
								<strong>Đang cập nhật</strong>
							@endif
						</p>
						<p class="fexi_header_para"><span>Khởi chiếu<label>:</label></span><strong>{{$release_date}}</strong></p>
						<p class="fexi_header_para">
							<span>Thời lượng<label>:</label></span>
							@if(!empty($movie->duration))
								<strong>{{$movie->duration}} phút</strong></p>
							@else
								<strong>Đang cập nhật</strong>
							@endif
						<p class="fexi_header_para">
							<span style="height: 22px;">Thể loại<label>:</label></span>
							@if(!empty($genre))
								@foreach($genre as $gen)
								<strong><a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a></strong><b>, </b>
								@endforeach
							@else
								<strong>Đang cập nhật</strong>
							@endif
						</p>
						<p class="fexi_header_para">
							<span>Giới hạn tuổi<label>:</label></span>
							@if(!empty($rated->rated_id))
								<strong>{{$rated->name}} - {{$rated->description}}</strong>
							@else
								<strong>Đang cập nhật</strong>
							@endif
						</p>
						<p class="fexi_header_para"><span>Rating<label>:</label></span>
							@if($rating != 0)
							<span style="float: right; margin-right: 46%; width: 40px; background: #fe423f; color: #ffffff;" class="rate_movie">{{$rating}}</span>
							@endif
							<ul class="mv-rating-stars">
								<li class="mv-current-rating user-rating" data-point="{{$rating*10}}%" style="width: {{$rating*10}}%;"></li>
							</ul>
							<strong style="color: #666; font-size: 14px;">&nbsp;({{$vote}} lượt)</strong>
						</p>
						@if(!empty($movie->imdb))
						<p class="fexi_header_para"><span>Điểm IMDB<label>:</label></span><strong style="color: #fe423f; font-size: 15px; font-weight: 800;">{{$movie->imdb}}</strong></p>
						@else
						<br>
						@endif

						<div class="list_button">
						@if($like == 0)
							<a href="{{route('addwatchlist',$movie->movie_id)}}"><button title="Thêm vào tủ phim" style="" type="button" class="btn btn-default like-movie"><i class="fa fa-heart"></i>&ensp;Thích</button></a>
						@elseif($like == 1)
							<a href="{{route('delwatchlist',$movie->movie_id)}}"><button title="Xóa khỏi tủ phim" style="background: #e9ecec;" type="button" class="btn btn-default unlike-movie"><i style="color: #fe423f;" class="fa fa-heart"></i>&ensp;Thích</button></a>
						@else
							<button type="button" class="btn btn-default like-movie"><i class="fa fa-heart"></i>&ensp;Thích</button>
						@endif
						@if($movie->type_id != 3)
							@if(Auth::user())
								@if($cmt->rate == 0)
								<a title="Viết đánh giá phim" href="#" data-toggle="modal" data-target="#myModal5"><button type="button" class="btn btn-default"><i class="fa fa-star"></i>&ensp;Đánh giá</button></a>
								@else
								<a title="Sửa đánh giá phim" href="#" data-toggle="modal" data-target="#myModal5"><button style="background: #e9ecec;" type="button" class="btn btn-default"><i style="color: #ffae00;" class="fa fa-star"></i>&ensp;Đánh giá</button></a>
								@endif
							@else
								<button data-toggle="collapse" data-target="#comment-rate" type="button" class="btn btn-default"><i class="fa fa-star"></i>&ensp;Đánh giá</button>							
							@endif
						@endif
						@if($movie->type_id != 2)
							<a target="_blank" href="{{$ticket}}" data-toggle="tooltip" title="Xem lịch chiếu và mua vé"><button style="border-color: #d43f3a;" type="button" class="btn btn-danger"><i class="fa fa-ticket"></i>&ensp;Mua vé</button></a>
						@endif
						</div>
						<div style="margin: 10px 0 0 20px; font-size: 17px;" id="comment-rate" class="collapse">			
							Vui lòng <a style="color: #fe423f;" href="{{route('login')}}">đăng nhập</a> để đánh giá
						</div>
					</div>
				</div>
				<div style="margin-bottom: 1.5em;" class="single video_agile_player">
					@if(!empty($movie->description))
					<h4 style="text-align: center; margin-bottom: 0; font-weight: bold;">Tóm tắt nội dung</h4>
					<p>{{$movie->description}}</p>
					@endif
					@if(!empty($movie->trailer))
					<div class="video-grid-single-page-agileits">
						<div id="video8">
							<iframe src="{{$movie->trailer}}" width="764" height="440" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>					
					</div>
					@endif
				</div>
				<i>Nguồn: {{$movie->url}}</i>				
				@if($movie->type_id != 3)
				<div class="response">
					<h4>Đánh giá ({{count($comments)}})</h4>
					<div class="comments-container">						
						<ul class="comments-list">
							@if(!empty($comment))
							<li>
								<div class="comment-main-level">
									<div class="comment-avatar"><img src="{{url($comment->getUser->avatar)}}" alt=""></div>
									<div class="comment-box">
										<div class="comment-head">
											<h6 class="comment-name by-author">{{$comment->getUser->name}}</h6>
											<i style="color: #fbf412; float: left; font-size: large;" class="fa fa-star"></i>
											<span><strong>&nbsp;{{$comment->rate}}</strong></span>	
											<div style="float: right; margin-right: 2em;">
												<div style="position: absolute;">
													<button style="background-color: #02a388; border-color: #dddfe2;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
													<span style="top: 0; color: #dddfe2;" class="caret"></span></button>
													<ul style="right: 0; left: unset; text-align: right; min-width: unset;" class="dropdown-menu">
													  <li style="margin-bottom: 0;"><a href="#" data-toggle="modal" data-target="#myModal5">Sửa</a></li>
													  <li style="margin-bottom: 0;" class="divider"></li>
													  <li style="margin-bottom: 0;"><a href="{{route('delcmt',$comment->cmt_id)}}">Xóa</a></li>
													</ul>
												</div>
											</div>											
											<span style="float: right; color: #1d2129; top: 4px; font-size: 13px; margin-right: 3em;">&nbsp;{{$comment->getDiffTime(strtotime($comment->time))}}</span>
											<i style="float: right; margin-top: 5px;" class="fa fa-clock-o"></i>
										</div>
										<div class="comment-content">{{$comment->content}}</div>
									</div>
								</div>
							</li>
							@endif
						</ul>
						<ul id="cmtList" class="comments-list">
							@if(Auth::user())
							@foreach($comments as $com)
								@if(Auth::user()->user_id != $com->user_id)	
								<li>
									<div class="comment-main-level">
										<div class="comment-avatar"><img src="{{url($com->getUser->avatar)}}" alt=""></div>
										<div class="comment-box">
											<div class="comment-head">
												<h6 class="comment-name by-author">{{$com->getUser->name}}</h6>
												<i style="color: #fbf412; float: left; font-size: large;" class="fa fa-star"></i>
												<span><strong>&nbsp;{{$com->rate}}</strong></span>
												<span style="float: right; color: #1d2129; top: 4px; font-size: 13px;">&nbsp;{{$com->getDiffTime(strtotime($com->time))}}</span>
												<i style="float: right; margin-top: 5px;" class="fa fa-clock-o"></i>
											</div>
											<div class="comment-content">
												@if($com->spoil == 1)
												<strong>Review có thể tiết lộ tình tiết phim! </strong>
												<a class="spoil" style="color: #02a388;" href="#spoil{{$com->cmt_id}}" data-toggle="collapse">Nhấn để xem</a>
												<div id="spoil{{$com->cmt_id}}" class="collapse">{{$com->content}}</div>
												@else
												<div>{{$com->content}}</div>
												@endif
											</div>
										</div>
									</div>
								</li>
								@endif
							@endforeach
							@else
							@foreach($comments as $com)
							<li>
								<div class="comment-main-level">
									<div class="comment-avatar"><img src="{{url($com->getUser->avatar)}}" alt=""></div>
									<div class="comment-box">
										<div class="comment-head">
											<h6 class="comment-name by-author">{{$com->getUser->name}}</h6>
											<i style="color: #fbf412; float: left; font-size: large;" class="fa fa-star"></i>
											<span><strong>&nbsp;{{$com->rate}}</strong></span>
											<span style="float: right; color: #1d2129; top: 4px; font-size: 13px;">&nbsp;{{$com->getDiffTime(strtotime($com->time))}}</span>
											<i style="float: right; margin-top: 5px;" class="fa fa-clock-o"></i>
										</div>
										<div class="comment-content">
											@if($com->spoil == 1)
											<strong>Review có thể tiết lộ tình tiết phim! </strong>
											<a class="spoil" style="color: #02a388;" href="#spoil{{$com->cmt_id}}" data-toggle="collapse">Nhấn để xem</a>
											<div id="spoil{{$com->cmt_id}}" class="collapse">{{$com->content}}</div>
											@else
											<div>{{$com->content}}</div>
											@endif
									</div>
								</div>
							</li>
							@endforeach
							@endif
						</ul>
					</div>
				</div>
				@endif
				<div class="response">
					<div class="agile-news-comments">
						<div class="agile-news-comments-info">
							<h4>Bình luận</h4>
							<div class="fb-comments" data-href="{{URL::current()}}" data-width="100%" data-numposts="5"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 latest-news-agile-right-content">
				<h4 style="margin-bottom: 0.7em;" class="side-t-w3l-agile">Tìm kiếm <span>phim</span></h4>
				<div class="side-bar-form">
					<form action="{{route('search')}}" method="get">
						<input type="search" name="keysearch" placeholder="Nhập từ khóa..." required="required">
						<input type="submit" value=" ">
					</form>
				</div>
				
				@if(count($reviews) != 0)
				<div class="agile-info-recent">
					<h4 class="side-t-w3l-agile"><span>Reviews</span> liên quan</h3>
					<div class="w3ls-recent-grids">
						@foreach($reviews as $review)
						<div style="margin-top: 1.2em;" class="w3l-recent-grid">
							<div class="wom">
								<a href="{{route('review',$review->review_id)}}"><img src="{{$review->image}}" alt=" " class="img-responsive"></a>
							</div>
							<div class="wom-right">
								<h5 title="{{$review->title}}"><a href="{{route('review',$review->review_id)}}">{{$review->title}}</a></h5>
								<!-- <p>{{$review->header}}</p> -->
								<ul class="w3l-sider-list">
									<?php $date = date_create($review->time); ?>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i>{{date_format($date,"d/m/Y")}}</li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endforeach
					</div>
				</div>
				@endif
				<!-- <h4 class="side-t-w3l-agile">Hot <span>News</span></h3>
				<ul class="side-bar-agile">
					<li><a href="single.html">John Abraham, Sonakshi Sinha and Tahir ...</a><p>Sep 29, 2016</p></li>
				</ul> -->
				<br>
				<h4 class="side-t-w3l-agile"><span>Trailer</span> phim mới</h4>
				
				<div class="video_agile_player sidebar-player">
					<div class="video-grid-single-page-agileits">
						<div id="video1">
							<iframe src="{{$tab->trailer}}" width="377" height="238" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<div class="player-text side-bar-info">
						<a style="text-decoration: none;" href="{{route('movie',$tab->movie_id)}}"><p class="fexi_header">{{$tab->name_vi}}</p></a>
						<p class="fexi_header_para"><span class="conjuring_w3">Nội dung<label style="left: 23%;">:</label></span>{{$tab_desc}}</p>
						<?php $date = date_create($tab->release_date); ?>
						<p class="fexi_header_para"><span>Khởi chiếu<label style="left: 23%;">:</label></span>{{date_format($date,"d/m/Y")}}</p>
						<p class="fexi_header_para"><span style="height: 22px;">Thể loại<label style="left: 23%;">:</label></span>
							@foreach($tab_genre as $gen)
							<a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a><b> | </b>
							@endforeach
						</p>
						@if($tab->getRating($tab->movie_id) != 0)
						<p class="fexi_header_para fexi_header_para1"><span>Rating<label style="left: 23%;">:</label></span><a><i class="fa fa-star" aria-hidden="true"></i></a> {{$tab->getRating($tab->movie_id)}}</p>
						@endif
					</div>
				</div>
				<div class="clearfix"> </div>
		
			</div>
			<div class="clearfix"></div>
		</div>

	</div>
</div>
<!--//content-inner-section-->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Đánh giá phim</h4>
				<div class="login-form">
					<form action="{{route('comment',$movie->movie_id)}}" method="post">
					{{ csrf_field() }}	
						<div class="rating">
						  <label title="Dở tệ">
						    <input type="radio" name="stars" value="1" <?php if($cmt->rate==1){ ?> checked <?php } ?> required/>
						    <span class="icon">★</span>
						  </label>
						  <label title="Dở">
						    <input type="radio" name="stars" value="2" <?php if($cmt->rate==2){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Không hay">
						    <input type="radio" name="stars" value="3" <?php if($cmt->rate==3){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>   
						  </label>
						  <label title="Không hay lắm">
						    <input type="radio" name="stars" value="4" <?php if($cmt->rate==4){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Bình thường">
						    <input type="radio" name="stars" value="5" <?php if($cmt->rate==5){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Xem được">
						    <input type="radio" name="stars" value="6" <?php if($cmt->rate==6){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Có vẻ hay">
						    <input type="radio" name="stars" value="7" <?php if($cmt->rate==7){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Hay">
						    <input type="radio" name="stars" value="8" <?php if($cmt->rate==8){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Rất hay">
						    <input type="radio" name="stars" value="9" <?php if($cmt->rate==9){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						  <label title="Tuyệt hay">
						    <input type="radio" name="stars" value="10" <?php if($cmt->rate==10){ ?> checked <?php } ?> />
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						    <span class="icon">★</span>
						  </label>
						</div>
					    <div class="form-group">
							<label style="margin-bottom: 5px;" for="comment">Review của bạn (có thể để trống)</label>
							<textarea name="review" class="form-control" rows="6" id="comment" placeholder="Đánh giá của bạn về bộ phim này">{{$cmt->content}}</textarea>
						</div>
						<div class="signin-rit">
							<div class="log-check">
								<label class="checkbox"><input type="checkbox" name="checkbox" <?php if($cmt->spoil==1){ ?> checked <?php } ?> >Review có chứa nội dung phim?</label>
							</div>
							@if($cmt->rate != 0)
							<div class="forgot">
								<a style="border-radius: 10px; color: #fff; padding: 2px 15px; margin-bottom: 10px;" href="{{route('delcmt',$cmt->cmt_id)}}" class="btn btn-danger" role="button">Xóa review</a>
							</div>
							@endif
						</div>
						<div class="tp">
							<input style="margin-top: 0;" type="submit" value="Đăng">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection