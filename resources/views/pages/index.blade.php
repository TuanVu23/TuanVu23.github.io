@extends('layouts.master')
@section('content')
<!--/content-inner-section-->
<div class="w3_content_agilleinfo_inner">
	<div class="agile_featured_movies">
		<!--/agileinfo_tabs-->
		<div class="agileinfo_tabs">
			<!--/tab-section-->
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Phim rạp mới nhất</li>				
					<li>Phim rating cao</li>
					<!-- <li>Popularity</li>	 -->				
				</ul>
				<div class="resp-tabs-container">
					<div class="tab1">
						<div class="tab_movies_agileinfo">
							<div class="w3_agile_featured_movies">
								<div class="col-md-5 video_agile_player">
									<div class="video-grid-single-page-agileits">
										<div id="video1">
											<iframe src="{{$new->trailer}}" width="533" height="336" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
										</div>
									</div>
									
									<div class="player-text">
										<a style="text-decoration: none;" href="{{route('movie',$new->movie_id)}}"><p class="fexi_header">{{$new->name_vi}}</p></a>
										<p class="fexi_header_para">
											@if(strlen($new_desc) < 140)
											<span class="conjuring_w3">Nội dung<label>:</label></span>{{$new_desc}}<br><br>
											@else
											<span class="conjuring_w3">Nội dung<label>:</label></span>{{$new_desc}}
											@endif
										</p>
										<p class="fexi_header_para"><span>Khởi chiếu<label>:</label></span>{{$new_date}}</p>
										<p class="fexi_header_para"><span>Thời lượng<label>:</label></span>{{$new->duration}} phút</p>
										<p class="fexi_header_para">
											<span style="height: 22px;">Thể loại<label>:</label></span>
											@foreach($new_genre as $gen)
											<a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a><b> | </b>
											@endforeach
										</p>
										<p class="fexi_header_para"><span>Giới hạn tuổi<label>:</label></span>{{$new_rated->name}} - {{$new_rated->description}}</p>
										@if($new->getRating($new->movie_id) != 0)
										<p class="fexi_header_para fexi_header_para1"><span>Rating<label>:</label></span>
										<a><i class="fa fa-star" aria-hidden="true"></i></a> {{$new->getRating($new->movie_id)}}</p>
										@endif
									</div>
								</div>
								<div class="col-md-7 wthree_agile-movies_list">
									@foreach($recent as $rec)
									<div class="w3l-movie-gride-agile">
										<a href="{{route('movie',$rec->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$rec->poster}}" title="{{$rec->name_vi}}" class="img-responsive" alt="{{$rec->poster}}">
											<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
										</a>
										<div class="mid-1 agileits_w3layouts_mid_1_home">
											<div class="w3l-movie-text">
												<h6><a title="{{$rec->name_vi}}" href="{{route('movie',$rec->movie_id)}}">{{$rec->name_vi}}</a></h6>
											</div>
											<div class="mid-2 agile_mid_2_home">
												<?php $date = date_create($rec->release_date); ?>
												<p>{{date_format($date,"d/m")}}</p>
												<div class="block-stars">
													@if($rec->rated_id == 1)
													<h4><span style="padding: .2em 1.3em .3em;" class="label label-success">P</span></h4>
													@elseif($rec->rated_id == 2)
													<h4><span style="background-color: #e4e823;" class="label">C-13</span></h4>
													@elseif($rec->rated_id == 3)
													<h4><span class="label label-warning">C-16</span></h4>
													@elseif($rec->rated_id == 4)
													<h4><span class="label label-danger">C-18</span></h4>
													@endif
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="ribben">
											<p>NEW</p>
										</div>
									</div>
									@endforeach
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="cleafix"></div>
						</div>
					</div>
					<div class="tab2">
						<div class="tab_movies_agileinfo">
							<div class="w3_agile_featured_movies">
								<div class="col-md-5 video_agile_player">
									<div class="video-grid-single-page-agileits">
										<div id="vidsoon1">
											<iframe src="{{$top->trailer}}" width="533" height="336" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
										</div>
									</div>
									
									<div class="player-text">
										<a style="text-decoration: none;" href="{{route('movie',$top->movie_id)}}"><p class="fexi_header">{{$top->name_vi}}</p></a>
										<p class="fexi_header_para">
											@if(strlen($top_desc) < 140)
											<span class="conjuring_w3">Nội dung<label>:</label></span>{{$top_desc}}<br><br><br>
											@else
											<span class="conjuring_w3">Nội dung<label>:</label></span>{{$top_desc}}
											@endif
										</p>
										<p class="fexi_header_para"><span>Khởi chiếu<label>:</label></span>{{$top_date}}</p>
										<p class="fexi_header_para"><span>Thời lượng<label>:</label></span>{{$top->duration}} phút</p>
										<p class="fexi_header_para">
											<span style="height: 22px;">Thể loại<label>:</label></span>
											@foreach($top_genre as $gen)
											<a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a><b> | </b>
											@endforeach
										</p>
										<p class="fexi_header_para"><span>Giới hạn tuổi<label>:</label></span>{{$top_rated->name}} - {{$top_rated->description}}</p>
										@if($top->getRating($top->movie_id) != 0)
										<p class="fexi_header_para fexi_header_para1"><span>Rating<label>:</label></span>
										<a><i class="fa fa-star" aria-hidden="true"></i></a> {{$top->getRating($top->movie_id)}}</p>
										@endif
									</div>
								</div>
								<div class="col-md-7 wthree_agile-movies_list">
									@foreach($rates as $rate)
									<div class="w3l-movie-gride-agile">
										<a href="{{route('movie',$rate->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$rate->poster}}" title="{{$rate->name_vi}}" class="img-responsive" alt="{{$rate->poster}}">
											<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
										</a>
										<div class="mid-1 agileits_w3layouts_mid_1_home">
											<div class="w3l-movie-text">
												<h6><a title="{{$rate->name_vi}}" href="{{route('movie',$rate->movie_id)}}">{{$rate->name_vi}}</a></h6>
											</div>
											<div class="mid-2 agile_mid_2_home">
												<?php $date = date_create($rate->release_date); ?>
												<p>{{date_format($date,"d/m")}}</p>
												<div class="block-stars">
													@if($rate->rated_id == 1)
													<h4><span style="padding: .2em 1.3em .3em;" class="label label-success">P</span></h4>
													@elseif($rate->rated_id == 2)
													<h4><span style="background-color: #e4e823;" class="label">C-13</span></h4>
													@elseif($rate->rated_id == 3)
													<h4><span class="label label-warning">C-16</span></h4>
													@elseif($rate->rated_id == 4)
													<h4><span class="label label-danger">C-18</span></h4>
													@endif
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="ribben">
											<p>HOT</p>
										</div>
									</div>
									@endforeach
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="cleafix"></div>
						</div>
					</div>
					<div class="tab3">

					</div>
				</div>
			</div>
		</div>
<!--//tab-section-->
<a style="text-decoration: none;" href="{{route('type',1)}}"><h3 class="agile_w3_title"> Phim <span>đang chiếu</span></h3></a>
<!--/movies-->
<div class="w3_agile_latest_movies">
<div id="owl-demo" class="owl-carousel owl-theme">
@foreach($latest as $late)
<div class="item">
	<div class="w3l-movie-gride-agile w3l-movie-gride-slider ">
		<a href="{{route('movie',$late->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$late->poster}}" title="{{$late->name_vi}}" class="img-responsive" alt="{{$late->poster}}" />
			<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
		</a>
		<div class="mid-1 agileits_w3layouts_mid_1_home">
			<div class="w3l-movie-text">
				<h6><a title="{{$late->name_vi}}" href="{{route('movie',$late->movie_id)}}">{{$late->name_vi}}</a></h6>
			</div>
			<div class="mid-2 agile_mid_2_home">
				<?php $date = date_create($late->release_date); ?>
				<p>{{date_format($date,"d/m")}}</p>
				<div class="block-stars">
					@if($late->rated_id == 1)
					<h4><span style="padding: .2em 1.3em .3em;" class="label label-success">P</span></h4>
					@elseif($late->rated_id == 2)
					<h4><span style="background-color: #e4e823;" class="label">C-13</span></h4>
					@elseif($late->rated_id == 3)
					<h4><span class="label label-warning">C-16</span></h4>
					@elseif($late->rated_id == 4)
					<h4><span class="label label-danger">C-18</span></h4>
					@endif
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="ribben one">
			<p>NOW</p>
		</div>
	</div>
</div>
@endforeach
</div>
</div>
<!--//movies-->
<h3 class="agile_w3_title">Phim được <span>gợi ý</span> </h3>
<!--/requested-movies-->
<div class="wthree_agile-requested-movies">
	@foreach($suggest as $sg)
	<div class="col-md-2 w3l-movie-gride-agile requested-movies">
		<a href="{{route('movie',$sg->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$sg->poster}}" title="{{$sg->name_vi}}" class="img-responsive" alt="{{$sg->poster}}" />
			<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
		</a>
		<div class="mid-1 agileits_w3layouts_mid_1_home">
			<div class="w3l-movie-text">
				<h6><a title="{{$sg->name_vi}}" href="{{route('movie',$sg->movie_id)}}">{{$sg->name_vi}}</a></h6>
			</div>
			<div class="mid-2 agile_mid_2_home">
				<?php $date = date_create($sg->release_date); ?>
				<p>{{date_format($date,"d/m")}}</p>
				<div class="block-stars">
					@if($sg->rated_id == 1)
					<h4><span style="padding: .2em 1.3em .3em;" class="label label-success">P</span></h4>
					@elseif($sg->rated_id == 2)
					<h4><span style="background-color: #e4e823;" class="label">C-13</span></h4>
					@elseif($sg->rated_id == 3)
					<h4><span class="label label-warning">C-16</span></h4>
					@elseif($sg->rated_id == 4)
					<h4><span class="label label-danger">C-18</span></h4>
					@endif
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		@if($sg->type_id == 1)
		<div class="ribben">
			<p>NOW</p>
		</div>
		@else
		<div class="ribben">
			<p>SOON</p>
		</div>
		@endif
	</div>
	@endforeach
	<div class="clearfix"></div>
</div>
<!--//requested-movies-->
<!--/top-movies-->
<a style="text-decoration: none;" href="{{route('type',3)}}"><h3 class="agile_w3_title">Phim <span>sắp chiếu</span> </h3></a>
<div class="top_movies">
	<div class="tab_movies_agileinfo">
		<div class="w3_agile_featured_movies two">
			<div class="col-md-7 wthree_agile-movies_list second-top">
				@foreach($soons as $soon)
				<div class="w3l-movie-gride-agile">
					<a href="{{route('movie',$soon->movie_id)}}" class="hvr-sweep-to-bottom"><img src="{{$soon->poster}}" title="{{$soon->name_vi}}" class="img-responsive" alt="{{$soon->poster}}">
						<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
					</a>
					<div class="mid-1 agileits_w3layouts_mid_1_home">
						<div class="w3l-movie-text">
							<h6><a title="{{$soon->name_vi}}" href="{{route('movie',$soon->movie_id)}}">{{$soon->name_vi}}</a></h6>
						</div>
						<div class="mid-2 agile_mid_2_home">
							<?php $date = date_create($soon->release_date); ?>
							<p>{{date_format($date,"d/m")}}</p>
							<div class="block-stars">
								@if($soon->rated_id == 1)
								<h4><span style="padding: .2em 1.3em .3em;" class="label label-success">P</span></h4>
								@elseif($soon->rated_id == 2)
								<h4><span style="background-color: #e4e823;" class="label">C-13</span></h4>
								@elseif($soon->rated_id == 3)
								<h4><span class="label label-warning">C-16</span></h4>
								@elseif($soon->rated_id == 4)
								<h4><span class="label label-danger">C-18</span></h4>
								@endif
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="ribben">
						<p>SOON</p>
					</div>
				</div>
				@endforeach
			</div>
			<div class="col-md-5 video_agile_player second-top">
				<div class="video-grid-single-page-agileits">
					<div id="video3">
						<iframe src="{{$soon1->trailer}}" width="533" height="336" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
					</div>
				</div>
				
				<div class="player-text two">
					<a style="text-decoration: none;" href="{{route('movie',$soon1->movie_id)}}"><p class="fexi_header">{{$soon1->name_vi}}</p></a>
					@if(!empty($soon1_desc))
					<p class="fexi_header_para">
						@if(strlen($soon1_desc) < 140)
						<span class="conjuring_w3">Nội dung<label>:</label></span>{{$soon1_desc}}<br><br><br>
						@else
						<span class="conjuring_w3">Nội dung<label>:</label></span>{{$soon1_desc}}
						@endif
					</p>
					@endif
					<p class="fexi_header_para"><span>Khởi chiếu<label>:</label></span>{{$soon1_date}}</p>
					@if(!empty($soon1->duration))
					<p class="fexi_header_para"><span>Thời lượng<label>:</label></span>{{$soon1->duration}} phút</p>
					@endif
					@if(!empty($soon1_genre))
					<p class="fexi_header_para">
						<span style="height: 22px;">Thể loại<label>:</label></span>
						@foreach($soon1_genre as $gen)
						<a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a><b> | </b>
						@endforeach
					</p>
					@endif
					@if(!empty($soon1_rated->rated_id))
					<p class="fexi_header_para"><span>Giới hạn tuổi<label>:</label></span>{{$soon1_rated->name}} - {{$soon1_rated->description}}</p>
					@endif
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="cleafix"></div>
</div>
</div>
<!--//top-movies-->
</div>
</div>
<!--//content-inner-section-->
@endsection