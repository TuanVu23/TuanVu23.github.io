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
	<h1 class="page-header">Slide
	<small>List</small>
	</h1>
</div>
<!-- /.col-lg-12 -->
<form class="form" action="{{route('updateslide')}}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr align="center">
				<th>ID</th>
				<th>Image</th>
				<th>Update<button style="margin-left: 4em;" type="submit" class="btn btn-success">Save</button></th>
			</tr>
		</thead>
		<tbody>
			@php $i = 1; @endphp
			@foreach($slides as $slide)
				@if($slide->slide_id%2 == 1)
				<tr class="odd gradeX" align="center">
				@else
				<tr class="even gradeC" align="center">
				@endif	
					<td>{{$slide->slide_id}}</td>
					<td><img src="{{url($slide->url)}}" class="img-responsive slideshow{{$i}}" alt="{{$slide->url}}"></td>
					<td class="center">						
						<input type="file" accept="image/*" class="text-center file-upload-slide{{$i}}" name="slide{{$i}}">	
					</td>
				</tr>
				<?php $i++; ?>
			@endforeach
		</tbody>
	</table>
</form>
@endsection