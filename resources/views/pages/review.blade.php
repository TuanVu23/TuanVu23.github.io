@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li><a href="{{route('reviews')}}">Reviews</a><i>//</i></li>
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
				<div class="inner-agile-w3l-part-head">
					<h3 style="color: #fe423f; text-transform: none;" class="w3l-inner-h-title">{{$review->title}}</h3>
					<!-- <p class="w3ls_head_para">Add short Description</p> -->
				</div>
				<div class="single video_agile_player">
					<div class="agile-post">
						<?php $date = date_create($review->time); ?>
						<i class="fa fa-calendar"></i>&nbsp;<a>{{date_format($date,"d/m/Y")}}</a>&emsp;<i class="fa fa-pencil-square-o"></i>&nbsp;<a rel="author">{{$review->getSource->name}}</a>&emsp;<i class="fa fa-eye"></i>&nbsp;{{$review->view}}
					</div>
					<h4 style="color: #444; font-weight: bold; text-align: justify;">{{$review->header}}</h4>
					@foreach($review->getContent as $content)
						@if($content->class == 'p')
							<p>{{$content->content}}</p>
						@elseif($content->class == 'img')
							<div class="video-grid-single-page-agileits">
								<img style="border-radius: .375rem;" src="{{$content->content}}" alt="{{$content->content}}" class="img-responsive">
							</div>
						@else
							<h4><strong>{{$content->content}}</strong></h4>
						@endif
					@endforeach
				</div>
				<div class="single-agile-shar-buttons">
					<a style="float: right; border-radius: .350rem; font-size: 16px; border-color: #0c0d0d;" href="{{route('movie',$review->movie_id)}}" class="btn btn-default" role="button">Xem thêm về bộ phim này</a>
					<h5 >Share This :</h5>
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
				<div class="response">
					
					<!-- agile-comments -->
					<div class="agile-news-comments">
						<div class="agile-news-comments-info">
							<h4>Bình luận</h4>
							<div class="fb-comments" data-href="{{URL::current()}}" data-width="100%" data-numposts="5"></div>
						</div>
					</div>
					<!-- //agile-comments -->
				</div>
			</div>
			<div class="col-md-4 latest-news-agile-right-content">
				<h4 style="margin-bottom: 0.7em;" class="side-t-w3l-agile">Tìm kiếm <span>review</span></h4>
				<div class="side-bar-form">
					<form action="{{route('search')}}" method="get">
						<input type="search" name="keysearch" placeholder="Nhập từ khóa..." required="required">
						<input type="submit" value=" ">
					</form>
				</div>
				<div class="agile-info-recent">
					<h4 class="side-t-w3l-agile"><span>Reviews</span> liên quan</h3>
					<div class="w3ls-recent-grids">
						@foreach($recent as $rec)
						<div style="margin-top: 1.2em;" class="w3l-recent-grid">
							<div class="wom">
								<a href="{{route('review',$rec->review_id)}}"><img src="{{$rec->image}}" alt=" " class="img-responsive"></a>
							</div>
							<div class="wom-right">
								<h5 title="{{$rec->title}}"><a href="{{route('review',$rec->review_id)}}">{{$rec->title}}</a></h5>
								<ul class="w3l-sider-list">
									<?php $date = date_create($rec->time); ?>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i>{{date_format($date,"d/m/Y")}}</li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endforeach
						@foreach($recent1 as $rec)
						<div style="margin-top: 1.2em;" class="w3l-recent-grid">
							<div class="wom">
								<a href="{{route('review',$rec->review_id)}}"><img src="{{$rec->image}}" alt=" " class="img-responsive"></a>
							</div>
							<div class="wom-right">
								<h5 title="{{$rec->title}}"><a href="{{route('review',$rec->review_id)}}">{{$rec->title}}</a></h5>
								<ul class="w3l-sider-list">
									<?php $date = date_create($rec->time); ?>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i>{{date_format($date,"d/m/Y")}}</li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endforeach
					</div>
				</div>
				<!-- <h4 class="side-t-w3l-agile">Hot <span>News</span></h3>
				<ul class="side-bar-agile">
					<li><a href="single.html">John Abraham, Sonakshi Sinha and Tahir ...</a><p>Sep 29, 2016</p></li>
				</ul> -->
				<br>
				<h4 class="side-t-w3l-agile"><span>Trailer</span> phim mới</h4>
				
				<div class="video_agile_player sidebar-player">
					<div class="video-grid-single-page-agileits">
						<div id="video1">
							<iframe src="{{$movie->trailer}}" width="377" height="238" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<div class="player-text side-bar-info">
						<a style="text-decoration: none;" href="{{route('movie',$movie->movie_id)}}"><p class="fexi_header">{{$movie->name_vi}}</p></a>
						<p class="fexi_header_para"><span class="conjuring_w3">Nội dung<label style="left: 23%;">:</label></span>{{$movie_desc}}</p>
						<?php $date = date_create($movie->release_date); ?>
						<p class="fexi_header_para"><span>Khởi chiếu<label style="left: 23%;">:</label></span>{{date_format($date,"d/m/Y")}}</p>
						<p class="fexi_header_para"><span style="height: 22px;">Thể loại<label style="left: 23%;">:</label></span>
							@foreach($genre as $gen)
							<a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a><b> | </b>
							@endforeach
						</p>
						@if($movie->getRating($movie->movie_id) != 0)
						<p class="fexi_header_para fexi_header_para1"><span>Rating<label style="left: 23%;">:</label></span><a><i class="fa fa-star" aria-hidden="true"></i></a> {{$movie->getRating($movie->movie_id)}}</p>
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
@endsection