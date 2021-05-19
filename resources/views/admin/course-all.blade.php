@extends('layouts.admin-app')
@section('content')
<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl=12">
	<font><strong><u>Tutorial Contents Of @if(isset($crash)) {{$crash->crash_name}} @endif</u></strong></font>
	<img src="{{asset('asset/crash/'.$crash->crash_image)}}" class="float-right rounded" height="50" width="50">
	<br><br><br>
	@if(isset($courses) && count($courses)>0)
	<ul class="list-group">
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-3 col-sm-12 col-12 col-lg-3">
					<strong>Step/Title</strong>
				</div>
				<div class="col-md-6 col-lg-6 col-12 col-sm-12">
					<strong>Youtube Video</strong>
				</div>
				<div class="col-md-3 col-sm-12 col-12 col-lg-3">
				    <strong>Action</strong>
				</div>
			</div>
		</li>
		@foreach($courses as $course)
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-3 col-sm-12 col-12 col-lg-3">
					{{$course->title}}
				</div>
				<div class="col-md-6 col-lg-6 col-12 col-sm-12">
					<iframe width="120" height="100" src="{{$course->link}}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="col-md-3 col-sm-12 col-12 col-lg-3">
					<a href="{{route('admin.course.content.read', $course->course_id)}}" class="btn btn-info">Read</a>
					<a href="{{route('admin.course.content.edit', $course->course_id)}}" class="btn btn-primary ml-2"><i class="fa fa-edit"></i></a>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	{{$courses->links()}}
	@else
	 <center><strong>Sorry !! Content not available please add first</strong> <a href="{{route('admin.course.getAdd', $crash->id)}}">Add Now</a></center>
	@endif
</div>
@endsection