@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li>Watchlist</li>
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<!--/content-inner-section-->
<div class="w3_content_agilleinfo_inner">

	<div class="agile_featured_movies">
		<div class="inner-agile-w3l-part-head">
			<h3 class="w3l-inner-h-title">Tủ phim của bạn</h3>
			@if(count($list) == 0)
			<p class="w3ls_head_para">Tủ phim rỗng</p>
			@endif
		</div>
		<!--/tv-movies-->
		<!-- <h3 class="agile_w3_title hor-t">Comedy<span>Movies</span> </h3> -->
		<div class="wthree_agile-requested-movies tv-movies">
			@foreach($list as $movie)
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
				<div style="top: 2%; padding-top: 6px; width: 30px;" class="ribben one">
					<p><a title="Xóa khỏi tủ phim" style="color: #ffffff;" href="{{route('delwatchlist',$movie->movie_id)}}"><i class="fa fa-times"></i></a></p>
				</div>
			</div>
			@endforeach
			<div class="clearfix"></div>
		</div>
		<!--//tv-movies-->
		
		<div class="blog-pagenat-wthree">
			<!-- <ul>
				<li><a class="frist" href="#">Prev</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				
				<li><a class="last" href="#">Next</a></li>
			</ul> -->
			
			<!--//requested-movies-->
			<h3 class="agile_w3_title">Phim được <span>gợi ý</span></h3>
			<!--/movies-->
			<div class="w3_agile_latest_movies">
				
				<div id="owl-demo" class="owl-carousel owl-theme">
					@foreach($suggest as $movie)
					<div class="item">
						<div class="w3l-movie-gride-agile w3l-movie-gride-slider ">
							<a href="{{route('movie',$movie->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$movie->poster}}" title="{{$movie->name_vi}}" class="img-responsive" alt="{{$movie->poster}}" />
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
							<div style="top: 2%; padding-top: 6px; width: 30px;" class="ribben one">
								<p><a title="Thêm vào tủ phim" style="color: #ffffff;" href="{{route('addwatchlist',$movie->movie_id)}}"><i class="fa fa-heart"></i></a></p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<!--//movies-->
		</div>
	</div>
</div>
<!--//content-inner-section-->
@endsection