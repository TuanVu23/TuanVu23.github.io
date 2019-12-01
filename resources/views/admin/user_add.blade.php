@extends('layouts.admin')
@section('content')
@if (Session::has('alert')) 
<div id="showalert" style="text-align: center; margin-bottom: -20px;" class="alert alert-success alert-dismissible">
    <button id="closealert" class="close" aria-label="close" title="Đóng">&times;</button>
    {{ Session::get('alert') }}  
</div>
<?php Session::forget('alert'); ?>
@endif
<div class="col-lg-12">
    <h1 class="page-header">User
    <small>Add</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{{route('user_addtodb')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>Name</label>
            <input class="form-control" id="name" type="text" name="name" placeholder="Họ tên" required="" " value="{{ old('name') }}" />
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>Email</label>
            <input class="form-control" id="email" type="email" name="email" placeholder="E-mail" required="" value="{{ old('email') }}" />
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>Password</label>
            <input class="form-control" id="password" type="password" name="password" placeholder="Mật khẩu" required="" />
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required="" />
        </div>      
        <div class="form-group">
            <label>Role</label>
            <label class="radio-inline">
                <input name="rdoLevel" value="0" checked="" type="radio">Member
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" type="radio">Admin
            </label>
        </div>
        <button type="submit" class="btn btn-default">Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form>
</div>
@endsection