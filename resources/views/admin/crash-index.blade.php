@extends('layouts.admin-app')
@section('content')
@if(isset($courses) && count($courses)>0)
<div class="row col-md-12">
	@foreach($courses as $course)
	<div class="col-md-6">
		<ul class="list-group">
			<center>
			<img src="{{asset('asset/crash/'.$course->crash_image)}}" height="150" width="150">
			</center>
			<li class="list-group-item"><b>{{$course->crash_name}}</b>
				<a href="{{route('admin.course.getAll', $course->id)}}" class="float-right btn btn-info btn-sm ml-2">View</a>
    			<a href="{{route('admin.course.getAdd', $course->id)}}" class="float-right btn btn-primary btn-sm">Add New Content</a>
			</li><br>
		</ul>
	</div>
	@endforeach
	@else
	<div class="alert alert-danger">
		<label>Sorry!! This Content is not available now, we will provide as soon as possible</label>
	</div>
</div>
@endif
@endsection