<!--/footer-bottom-->
<div class="contact-w3ls" id="contact">
	<div class="footer-w3lagile-inner">
		<h2>Sign up for our <span>Newsletter</span></h2>
		<!-- <p class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros eget tellus
		tristique bibendum. Donec rutrum sed sem quis venenatis.</p> -->
		<div class="footer-contact">
			<form action="#" method="post">
				<input type="email" name="Email" placeholder="Enter your email...." required=" ">
				<input type="submit" value="Subscribe">
			</form>
		</div>
		<div class="footer-grids w3-agileits">
			<div class="col-md-2 footer-grid">
				<h4>Release</h4>
				<ul>
					<li><a href="#" title="Release 2016">2019</a></li>
					<li><a href="#" title="Release 2015">2018</a></li>
					<li><a href="#" title="Release 2014">2017</a></li>
					<li><a href="#" title="Release 2013">2016</a></li>
					<li><a href="#" title="Release 2012">2015</a></li>
					<li><a href="#" title="Release 2011">2014</a></li>
				</ul>
			</div>
			<div class="col-md-2 footer-grid">
				<h4>Latest Movies</h4>
				<ul>
					@foreach($movies as $movie)
					<li><a title="{{$movie->name_vi}}" style="text-transform: uppercase;" href="{{route('movie',$movie->movie_id)}}">{{$movie->name_en}}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-2 footer-grid">
				<h4>Genres</h4>
				<ul class="w3-tag2">
					@foreach($genres as $gen)
					<li><a href="{{route('genre',$gen->genre_id)}}">{{$gen->name}}</a></li>
					@endforeach					
				</ul>
			</div>
			<div class="col-md-2 footer-grid">
				<h4>Reviews</h4>
				@foreach($reviews as $review)
				<div class="footer-grid1">
					<div class="footer-grid1-left">
						<a title="{{$review->title}}" href="{{route('review',$review->review_id)}}"><img src="{{$review->image}}" alt=" " class="img-responsive"></a>
					</div>
					<div class="footer-grid1-right">
						<a style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" href="{{route('review',$review->review_id)}}">{{$review->title}}</a>
					</div>
					<div class="clearfix"> </div>
				</div>
				@endforeach
			</div>
			<div class="col-md-2 footer-grid">
				<h4 class="b-log"><a href="{{route('index')}}"><span>M</span>ovies <span>P</span>ro</a></h4>
				@foreach($movies as $movie)
				<div class="footer-grid-instagram">
					<a title="{{$movie->name_vi}}" href="{{route('movie',$movie->movie_id)}}"><img src="{{$movie->poster}}" alt=" " class="img-responsive"></a>
				</div>
				@endforeach
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
			<ul class="bottom-links-agile">
				<li><a href="{{route('index')}}">Home</a></li>
				<li><a href="{{route('reviews')}}">Review</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
		</div>
		<h3 class="text-center follow">Connect <span>Us</span></h3>
		<ul class="social-icons1 agileinfo">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
			<li><a href="#"><i class="fa fa-youtube"></i></a></li>
			<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
		</ul>
	</div>
</div>
<div class="w3agile_footer_copy">
	<p>© 2019 Movies Pro. All rights reserved</p>
</div>
<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>