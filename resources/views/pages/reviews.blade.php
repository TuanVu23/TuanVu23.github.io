@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li>Reviews</li>
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<!--/content-inner-section-->
<div class="w3_content_agilleinfo_inner">
	<div class="agile_featured_movies">
		<div style="margin-bottom: 3em;" class="inner-agile-w3l-part-head">
			<h3 class="w3l-inner-h-title">Đánh giá phim</h3>
			<p class="w3ls_head_para">Góc nhìn chân thực, khách quan nhất về các bộ phim</p>
		</div>
		<div class="latest-news-agile-info">
			<div class="col-md-8 latest-news-agile-left-content">
				@foreach($reviews as $review)				
				<div class="w3-agileits-news-one">
					<div class="wthree-news-img">
						<a href="{{route('review',$review->review_id)}}"><img src="{{$review->image}}" alt=" "></a>
					</div>
					<div class="wthree-news-info">
						<h5><a href="{{route('review',$review->review_id)}}">{{$review->title}}</a></h5>
						<div class="agile-post">
							<?php $date = date_create($review->time); ?>
							<i class="fa fa-pencil-square-o"></i>&nbsp;<a rel="author">{{$review->getSource->name}}</a>&ensp;<i class="fa fa-calendar"></i>&nbsp;<a>{{date_format($date,"d/m/Y")}}</a>
						</div>
						<p>{{$review->header}}</p>						
					</div>
					<div class="clearfix"> </div>
					@if((++$count)%8 != 0)
					<hr>
					@endif
				</div>							
				@endforeach
				<div class="blog-pagenat-wthree">{{$reviews->links()}}</div>
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
					<h4 class="side-t-w3l-agile"><span>Reviews</span> xem nhiều</h4>
					<div class="w3ls-recent-grids">
						@foreach($hot_review as $hot)
						<div style="margin-top: 1.2em;" class="w3l-recent-grid">
							<div class="wom">
								<a href="{{route('review',$hot->review_id)}}"><img src="{{$hot->image}}" alt=" " class="img-responsive"></a>
							</div>
							<div class="wom-right">
								<h5 title="{{$hot->title}}"><a href="{{route('review',$hot->review_id)}}">{{$hot->title}}</a></h5>
								<ul class="w3l-sider-list">
									<?php $date = date_create($hot->time); ?>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i>{{date_format($date,"d/m/Y")}}</li>
									<li><i class="fa fa-eye" aria-hidden="true"></i>{{$hot->view}}</li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endforeach
					</div>
				</div>	
				<!-- <h4 class="side-t-w3l-agile">Hot <span>Topics</span></h3>
				<ul class="side-bar-agile">
					<li><a href="news-single.html">John Abraham, Sonakshi Sinha and Tahir ...</a><p>Sep 29, 2016</p></li>
				</ul> -->
				<br>
				<h4 class="side-t-w3l-agile"><span>Trailer</span> phim mới</h3>
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