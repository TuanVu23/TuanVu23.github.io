@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li>Search</li>
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<!--/content-inner-section-->
<div class="w3_content_agilleinfo_inner">
	<div class="agile_featured_movies">
		@if($result == 1)
		<div class="inner-agile-w3l-part-head">
			<h3 class="w3l-inner-h-title">Kết quả tìm kiếm</h3>
			<p class="w3ls_head_para">Từ khóa: "{{$keysearch}}"</p>
		</div>		
		<div class="wthree_agile-requested-movies tv-movies">
			<h3 style="text-align: center;" class="agile_w3_title hor-t"><span>Phim</span></h3>
			@foreach($movies as $movie)
			<div class="col-md-2 w3l-movie-gride-agile requested-movies">
				<a href="{{route('movie',$movie->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$movie->poster}}" title="{{$movie->name_vi}}" class="img-responsive" alt="{{$movie->poster}}">
					<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
				</a>
				<div class="mid-1 agileits_w3layouts_mid_1_home">
					<div class="w3l-movie-text">
						<h6><a title="{{$movie->name_vi}}" href="{{route('movie',$movie->movie_id)}}">{{$movie->name_vi}}</a></h6>
					</div>
					<div class="mid-2 agile_mid_2_home">
						<?php $date = date_create($movie->release_date); ?>
						<p>{{date_format($date,"d/m")}}</p>
						<div class="block-stars">
							@if($movie->rated_id == 1)
							<h4><span style="padding: .2em 1.3em .3em;" class="label label-success">P</span></h4>
							@elseif($movie->rated_id == 2)
							<h4><span style="background-color: #e4e823;" class="label">C-13</span></h4>
							@elseif($movie->rated_id == 3)
							<h4><span class="label label-warning">C-16</span></h4>
							@elseif($movie->rated_id == 4)
							<h4><span class="label label-danger">C-18</span></h4>
							@endif
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				@if($movie->type_id == 1)
				<div class="ribben">
					<p>NOW</p>
				</div>
				@elseif($movie->type_id == 3)
				<div class="ribben">
					<p>SOON</p>
				</div>
				@endif
			</div>
			@endforeach
			<div class="clearfix"></div>
		</div>
		<!-- <div class="blog-pagenat-wthree"></div> -->
		<div class="latest-news-agile-info">
			<h3 style="text-align: center; margin-top: 1.5em;" class="agile_w3_title hor-t"><span>Reviews</span></h3>
			<div class="col-md-10 latest-news-agile-left-content">			
				@foreach($movies as $movie)
					@foreach($movie->getReviews as $review)		
				<div class="w3-agileits-news-one">
					<div class="wthree-news-img">
						<a href="{{route('review',$review->review_id)}}"><img src="{{$review->image}}" alt="{{$review->image}}"></a>
					</div>
					<div class="wthree-news-info">
						<h5><a href="{{route('review',$review->review_id)}}">{{$review->title}}</a></h5>
						<div class="agile-post">
							<?php $date = date_create($review->time); ?>
							<i class="fa fa-pencil-square-o"></i>&nbsp;<a rel="author">{{$review->getSource->name}}</a>&emsp;<i class="fa fa-calendar"></i>&nbsp;<a>{{date_format($date,"d/m/Y")}}</a>
						</div>
						<p>{{$review->header}}</p>						
					</div>
					<div class="clearfix"> </div>
					<hr>
				</div>
					@endforeach
				@endforeach				
				<div class="blog-pagenat-wthree"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		@else
		<div class="inner-agile-w3l-part-head">
			<h3 class="w3l-inner-h-title">Không tìm thấy kết quả</h3>
			<p class="w3ls_head_para">Từ khóa: "{{$keysearch}}"</p>
		</div>
		@endif
	</div>
</div>

<!--//content-inner-section-->
@endsection