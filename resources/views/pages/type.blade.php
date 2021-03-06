@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			@if($type_id == 1)
			<li>Now showing</li>
			@elseif($type_id == 3)
			<li>Coming soon</li>
			@else
			<li>On this month</li>
			@endif
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<!--/content-inner-section-->
<div class="w3_content_agilleinfo_inner">

	<div class="agile_featured_movies">
		<div style="margin-bottom: 3em;" class="inner-agile-w3l-part-head">
			@if($type_id == 1)
			<h3 class="w3l-inner-h-title">Phim đang chiếu</h3>
			<p class="w3ls_head_para">Danh sách các phim hiện đang chiếu tại các hệ thống rạp trên toàn quốc</p>
			@elseif($type_id == 3)
			<h3 class="w3l-inner-h-title">Phim sắp chiếu</h3>
			<p class="w3ls_head_para">Danh sách các phim dự kiến sẽ khởi chiếu tại các hệ thống rạp trên toàn quốc</p>
			@else
			<h3 class="w3l-inner-h-title">Phim trong tháng này</h3>
			<p class="w3ls_head_para">Danh sách các phim khởi chiếu trong tháng {{$month}} tại các hệ thống rạp trên toàn quốc</p>
			@endif
		</div>
		<!--/tv-movies-->
		<!-- <h3 class="agile_w3_title hor-t">Comedy<span>Movies</span> </h3> -->
		<div class="wthree_agile-requested-movies tv-movies">
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
		</div>
	</div>
</div>
<!--//content-inner-section-->
@endsection