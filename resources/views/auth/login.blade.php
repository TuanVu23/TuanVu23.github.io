@extends('layouts.main')
@section('content')
<!-- breadcrumb -->
<div class="w3_breadcrumb">
	<div class="breadcrumb-inner">
		<ul>
			<li><a href="{{route('index')}}">Home</a><i>//</i></li>
			<li>Login</li>
		</ul>
	</div>
</div>
<!-- //breadcrumb -->
<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<h4>Đăng nhập</h4>
			<div class="login-form">
				@if(Session::has('message'))
                <div style="margin-top: 1em; text-align: center;" class="alert alert-success">
                    {{ Session::get('message') }}
                    @php
                    Session::forget('message');
                    @endphp
                </div>
                @endif
				<form action="{{ route('login') }}" method="post">
					{{ csrf_field() }}
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
					<div class="tp">
						<input type="submit" value="ĐĂNG NHẬP NGAY">
					</div>
					<div class="forgot-grid">
						<div class="log-check">
							<label class="checkbox"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Nhớ mật khẩu</label>
						</div>
						<div class="forgot">
							<a href="{{ route('password.request') }}">Bạn quên mật khẩu?</a>
						</div>
						<div class="clearfix"></div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection