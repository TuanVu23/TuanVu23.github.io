<!--/main-header-->
<!--/banner-section-->
<div id="demo-1" class="banner-inner">
	<div class="banner-inner-dott">
		<!--/header-w3l-->
		<div class="header-w3-agileits" id="home">
			<div class="inner-header-agile part2">
				<nav class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<h1><a  href="{{route('index')}}"><span>M</span>ovies <span>P</span>ro</a></h1>
					</div>
					<!-- navbar-header -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active"><a href="{{route('index')}}">Home</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Phim <b class="caret"></b></a>
								<ul style="width: 170px;" class="dropdown-menu multi-column columns-1">
									<li>
										<div class="col-sm-12">
											<ul class="multi-column-dropdown">
												<li><a href="{{route('type',1)}}">Phim đang chiếu</a></li>
												<li><a href="{{route('type',3)}}">Phim sắp chiếu</a></li>
												<li><a href="{{route('type',4)}}">Phim trong tháng</a></li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</li>
								</ul>
							</li>
							<li><a href="{{route('reviews')}}">đánh giá phim</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Thể loại <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-3">
									<li>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												@foreach($genre1 as $gen)
												<li><a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a></li>
												@endforeach
											</ul>
										</div>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												@foreach($genre2 as $gen)
												<li><a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a></li>
												@endforeach
											</ul>
										</div>
										<div class="col-sm-4">
											<ul class="multi-column-dropdown">
												@foreach($genre3 as $gen)
												<li><a href="{{route('genre',$gen->genre_id)}}">{{$gen->description}}</a></li>
												@endforeach
											</ul>
										</div>
										<div class="clearfix"></div>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Lịch chiếu phim <b class="caret"></b></a>
								<ul style="width: 170px;" class="dropdown-menu multi-column columns-1">
									<li>
										<div class="col-sm-12">
											<ul class="multi-column-dropdown">
												<li><a target="_blank" href="https://www.cgv.vn/default/movies/now-showing.html">Rạp CGV</a></li>
												<li><a target="_blank" href="https://www.galaxycine.vn/lich-chieu">Rạp Galaxy</a></li>
												<li><a target="_blank" href="http://www.lottecinemavn.com/LCHS/Contents/ticketing/movie-schedule.aspx">Rạp Lotte</a></li>
												<li><a target="_blank" href="https://www.bhdstar.vn/lich-chieu-theo-phim/">Rạp BHD</a></li>
												<li><a target="_blank" href="https://chieuphimquocgia.com.vn/showtimes-lich-chieu-phim">Rạp quốc gia</a></li>
											</ul>
										</div>
										<div class="clearfix"></div>
									</li>
								</ul>
							</li>
							<!-- <li><a href="list.html">A - z list</a></li> -->
							<!-- <li><a href="contact.html">Liên hệ</a></li> -->
						</ul>
					</div>
					<div class="clearfix"> </div>
				</nav>
				<div class="w3ls_search">
					<div class="cd-main-header">
						<ul class="cd-header-buttons">
							<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
							</ul> <!-- cd-header-buttons -->
						</div>
						<div id="cd-search" class="cd-search">
							<form action="{{route('search')}}" method="get">
								<input name="keysearch" type="search" placeholder="Nhập từ khóa..." required="">
							</form>
						</div>
					</div>
					
				</div>
			</div>
			<!--//header-w3l-->
		</div>
	</div>
	<!--/banner-section-->
	<!--//main-header-->
