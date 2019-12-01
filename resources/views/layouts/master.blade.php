<!DOCTYPE html>
<html>
	<head>
		<title>Movies Pro</title>
		<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Movies Pro Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //for-mobile-apps -->
		<link href="{{url('source/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
		<!-- pop-up -->
		<link href="{{url('source/css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all" />
		<!-- //pop-up -->
		<link href="{{url('source/css/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" type="text/css" href="{{url('source/css/zoomslider.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{url('source/css/style.css')}}" />
		<link href="{{url('source/css/font-awesome.css')}}" rel="stylesheet">
		<script type="text/javascript" src="{{url('source/js/modernizr-2.6.2.min.js')}}"></script>
		<!--/web-fonts-->
		<link href='//fonts.googleapis.com/css?family=Tangerine:400,700' rel='stylesheet' type='text/css'>
		<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900" rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!--//web-fonts-->
	</head>
	<body>
		@include('layouts.header')
		@include('layouts.toolbar')
		@yield('content')
		@include('layouts.footer')		
		<script src="{{url('source/js/jquery-1.11.1.min.js')}}"></script>
		<!-- Dropdown-Menu-JavaScript -->
		<script>
			$(document).ready(function(){
				$(".dropdown").hover(
					function() {
						$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
						$(this).toggleClass('open');
					},
					function() {
						$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
						$(this).toggleClass('open');
					}
				);
			});
		</script>
		<!-- //Dropdown-Menu-JavaScript -->
		<script type="text/javascript" src="{{url('source/js/jquery.zoomslider.min.js')}}"></script>
		<!-- search-jQuery -->
		<script src="{{url('source/js/main.js')}}"></script>
		<script src="{{url('source/js/simplePlayer.js')}}"></script>
		<script>
			$("document").ready(function() {
				$("#video").simplePlayer();
			});
		</script>
		<script>
			$("document").ready(function() {
				$("#video1").simplePlayer();
			});
		</script>
		<script>
			$("document").ready(function() {
				$("#video2").simplePlayer();
			});
		</script>
		<script>
		$("document").ready(function() {
			$("#video3").simplePlayer();
		});
		</script>
		<!-- pop-up-box -->
		<script src="{{url('source/js/jquery.magnific-popup.js')}}" type="text/javascript"></script>
		<!--//pop-up-box -->
		<div id="small-dialog1" class="mfp-hide">
		<iframe src="https://player.vimeo.com/video/245487755?color=ffffff&title=0&byline=0&portrait=0"></iframe>
		</div>
		<div id="small-dialog2" class="mfp-hide">
		<iframe src="https://player.vimeo.com/video/245487755?color=ffffff&title=0&byline=0&portrait=0"></iframe>
		</div>
		<script>
			$(document).ready(function() {
			$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});
																			
			});
		</script>
		<script src="{{url('source/js/easy-responsive-tabs.js')}}"></script>
		<script>
		$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion
		width: 'auto', //auto or any width like 600px
		fit: true,   // 100% fit in a container
		closed: 'accordion', // Start closed if in accordion view
		activate: function(event) { // Callback function if tab is switched
		var $tab = $(this);
		var $info = $('#tabInfo');
		var $name = $('span', $info);
		$name.text($tab.text());
		$info.show();
		}
		});
		$('#verticalTab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto',
		fit: true
		});
		});
		</script>
		<link href="{{url('source/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" media="all">
		<script src="{{url('source/js/owl.carousel.js')}}"></script>
		<script>
			$(document).ready(function() {
				$("#owl-demo").owlCarousel({
			
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				autoPlay : true,
				navigation :true,
				items : 5,
				itemsDesktop : [640,4],
				itemsDesktopSmall : [414,3]
			
				});
			
			});
		</script>
		<!--/script-->
		<script type="text/javascript" src="{{url('source/js/move-top.js')}}"></script>
		<script type="text/javascript" src="{{url('source/js/easing.js')}}"></script>
		<script type="text/javascript">
					jQuery(document).ready(function($) {
								$(".scroll").click(function(event){
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
						});
					});
		</script>
		<script type="text/javascript">
								$(document).ready(function() {
									/*
									var defaults = {
										containerID: 'toTop', // fading element id
										containerHoverID: 'toTopHover', // fading element hover id
										scrollSpeed: 1200,
										easingType: 'linear'
									};
									*/
									
									$().UItoTop({ easingType: 'easeOutQuart' });
									
								});
		</script>
		<!--end-smooth-scrolling-->
		<script src="{{url('source/js/bootstrap.js')}}"></script>
	</body>
</html>