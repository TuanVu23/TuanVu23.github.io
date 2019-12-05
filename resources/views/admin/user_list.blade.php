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
	<small>List</small>
	</h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Email</th>
			<th>Role</th>
			<th>Name</th>
			<th>Action</th>
			<!-- <th>Edit</th> -->
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
			@if($user->user_id%2 == 1)
			<tr class="odd gradeX" align="center">
			@else
			<tr class="even gradeC" align="center">
			@endif	
				<td>{{$user->user_id}}</td>
				<td>{{$user->email}}</td>
				@if($user->role == 0)
				<td>Member</td>
				@else
				<td>Admin</td>
				@endif
				<td>{{$user->name}}</td>
				<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('user_del',$user->user_id)}}"> Delete</a></td>
				<!-- <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td> -->
			</tr>
		@endforeach
	</tbody>
</table>
@endsection