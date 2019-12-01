<div class="w3_agilits_banner_bootm">
	<div class="w3_agilits_inner_bottom">
		<div class="col-md-9 wthree_share_agile">			
			<div class="single-agile-shar-buttons">
				<ul>
					<li style="letter-spacing: 1px; list-style: none; display: inline-block; color: #fff; margin-right: 1em;"><i class="fa fa-phone" aria-hidden="true"></i> (+84) 123 456 789</li>
					<li>
						<div class="fb-like" data-href="https://www.facebook.com/TrenDuongPitch/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
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
		<div class="col-md-3 wthree_agile_login">
			@if(Auth::user())
			<div class="user-avatar" >
				<img style="height: 100%; width: 100%;" title="{{Auth::user()->name}}" class="dropdown-toggle img-responsive" data-toggle="dropdown" src="{{url(Auth::user()->avatar)}}" alt="">
				<ul id="usercase" class="dropdown-menu">
					<li><a href="{{route('account')}}">Tài&nbsp;khoản</a></li>
					<li><a href="{{route('watchlist')}}">Tủ&nbsp;phim</a></li>
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng&nbsp;xuất</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</div>
			<!-- <div class="user-avatar" data-toggle="collapse" data-target="#usercase">
				<img style="height: 100%; width: 100%;" title="{{Auth::user()->name}}" class="img-responsive" src="{{url(Auth::user()->avatar)}}" alt="">
				<div id="usercase" class="collapse">
				  <ul>
				    <li><a href="{{route('account')}}">Tài&nbsp;khoản</a></li>
				    <li><a href="{{route('watchlist')}}">Tủ&nbsp;phim</a></li>
				    <li>
				    	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng&nbsp;xuất</a>
				    	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
				    </li>
				  </ul>
				</div>
			</div>  -->
			@else
			<ul>
				<li><a href="{{ route('login') }}" class="login">Đăng nhập</a></li>
				<li><a href="{{ route('register') }}" class="login reg">Đăng ký</a></li>
			</ul>
			@endif
		</div>
	</div>
</div>
