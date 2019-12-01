@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li>Register</li>
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<h4>Đăng ký</h4>
			<div class="login-form">
				<form action="{{ route('register') }}" method="post">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<input id="name" type="text" name="name" placeholder="Họ tên" required="" " value="{{ old('name') }}">
						@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input id="email" type="email" name="email" placeholder="E-mail" required="" value="{{ old('email') }}">
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<input id="password" type="password" name="password" placeholder="Mật khẩu" required="">
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					<input id="password-confirm" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required="">
					<div class="tp">
						<input type="submit" value="ĐĂNG KÝ NGAY">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection