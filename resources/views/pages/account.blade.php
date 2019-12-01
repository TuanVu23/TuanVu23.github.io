@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li>Account</li>
		</ul>
	</div>
</div>
<div class="w3_content_agilleinfo_inner">
	<div class="agile_featured_movies">
		<div class="inner-agile-w3l-part-head">
			<h3 class="w3l-inner-h-title">Quản lý tài khoản</h3>
			<!-- <p class="w3ls_head_para">Tủ phim rỗng</p> -->
		</div>
		<div class="container bootstrap snippet">
			<!-- <div class="row">
				<div class="col-sm-10"><h1>User name</h1></div>
				<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
			</div> -->
			<div class="row">
				<div class="col-sm-3"><!--left col-->
				
					<div class="text-center">
						<h4 style="margin-bottom: 10px; font-weight: bold;">{{$user->name}}</h4>
						<img style="max-width: 80%;" src="{{url($user->avatar)}}" class="acc-avatar img-circle img-thumbnail" alt="avatar">
						<!-- <h6>Upload a different photo...</h6> -->						
					</div>
					<!-- <hr><br> -->				
					<!-- <div class="panel panel-default">
						<div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
						<div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
					</div>
					<ul class="list-group">
						<li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
						<li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
						<li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
						<li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
						<li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
					</ul>		
					<div class="panel panel-default">
						<div class="panel-heading">Social Media</div>
						<div class="panel-body">
							<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
						</div>
					</div> -->
				
				</div><!--/col-3-->
				<div class="col-sm-9">
					
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#profile">Thông tin cá nhân</a></li>					
						<li><a data-toggle="tab" href="#avatar">Thay ảnh đại diện</a></li>
						<li><a data-toggle="tab" href="#password">Đổi mật khẩu</a></li>
						@if (Session::has('alert'))
						<li>
						    <div id="showalert" style="text-align: center; padding: 10px; margin-bottom: -10px;" class="alert alert-success alert-dismissible">
						    	<button style="top: 0; right: -5px;" id="closealert" class="close" aria-label="close" title="Đóng">&times;</button>
						    	{{ Session::get('alert') }}  
						    </div>
						</li>
						    <?php Session::forget('alert'); ?>
						@endif
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active" id="profile">
							<hr>
							<form class="form" action="{{route('updateinfo')}}" method="post">
								{{ csrf_field() }}
								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<div class="col-xs-6">
										<label style="margin-bottom: 10px;" for="name"><h4 style="font-weight: bold;">Họ tên</h4></label>
										<input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" required>
										@if ($errors->has('name'))
										<span class="help-block">
										 	<strong>{{ $errors->first('name') }}</strong>
										</span>
										@endif
									</div>
								</div>
								<div class="form-group">									
									<div class="col-xs-6">
										<label style="margin-bottom: 10px;" for="email"><h4 style="font-weight: bold;">Email</h4></label>
										<input type="text" class="form-control" value="{{$user->email}}" disabled>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<br>
										<button name="update-info" style="border-radius: 4px; margin-right: 10px; background-color: #02a388; border-color: unset;" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
										<button style="border-radius: 4px;" class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
									</div>
								</div>
							</form>
							
						</div><!--/tab-pane-->

						<div class="tab-pane" id="avatar">
							<hr>
							<form class="form" action="{{route('updateavatar')}}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
								<div class="form-group">									
									<div class="col-xs-12">
										<input type="file" accept="image/*" data-default-file="{{url($user->avatar)}}" class="text-center file-upload-avatar" name="avatar" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<br>
										<button style="border-radius: 4px; background-color: #02a388; border-color: unset;" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
									</div>
								</div>
							</form>
						</div>

						<div class="tab-pane" id="password">							
							<hr>
							<form class="form" action="{{route('changepass')}}" method="post">
								{{ csrf_field() }}
								<div class="form-group">									
									<div class="col-xs-6">
										<label style="margin-bottom: 10px;" for="first_name"><h4 style="font-weight: bold;">Mật khẩu hiện tại</h4></label>
										<input type="text" class="form-control" name="old_pass" placeholder="Nhập mật khẩu hiện tại" required>
									</div>
								</div>
								<div class="form-group">									
									<div class="col-xs-6">
										<label style="margin-bottom: 10px;" for="last_name"><h4 style="font-weight: bold;">Mật khẩu mới</h4></label>
										<input type="text" class="form-control" name="new_pass" placeholder="Nhập mật khẩu mới" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<br>
										<button style="border-radius: 4px; margin-right: 10px; background-color: #02a388; border-color: unset;" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
										<button style="border-radius: 4px;" class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
									</div>
								</div>
							</form>
							
						</div><!--/tab-pane-->					
								
					</div><!--/tab-pane-->
				</div><!--/tab-content-->
			</div><!--/col-9-->
		</div>
	</div>
</div>
@endsection