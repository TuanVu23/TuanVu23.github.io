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
	<h1 class="page-header">Review
	<small>List</small>
	</h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>User ID</th>
			<th>Movie</th>			
			<th>Content</th>
			<th>Rating</th>
			<th>Spoil</th>
			<th>Time</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		@foreach($reviews as $review)
			@if($review->cmt_id%2 == 1)
			<tr class="odd gradeX" align="center">
			@else
			<tr class="even gradeC" align="center">
			@endif	
				<td>{{$review->cmt_id}}</td>
				<td style="cursor: pointer;" title="{{$review->getUser->name}}">{{$review->user_id}}</td>
				<td>{{$review->getMovie->name_vi}}</td>
				<td>{{$review->content}}</td>
				<td>{{$review->rate}}</td>
				@if($review->spoil == 0)
				<td>No</td>
				@else
				<td>Yes</td>
				@endif
				<td>{{$review->time}}</td>
				<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('review_del',$review->cmt_id)}}"> Delete</a></td>
				<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('review_edit',$review->cmt_id)}}">Edit</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection