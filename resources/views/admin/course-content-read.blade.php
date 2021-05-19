@extends('layouts.admin-app')
@section('content')
<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">
	<font><strong><u>Tutorial Contents Of @if(isset($crash)) {{$crash->crash_name}} @endif</u></strong></font>
	<img src="{{asset('asset/crash/'.$crash->crash_image)}}" class="float-right rounded" height="50" width="50">
	<br><br><br>
	<div class="row">
		<dic class="col-md-8 col-lg-8 col-xl-8 xol-12 xol-sm-12">
			{!! $course->description !!}
		</dic>
		<div class="col-md-4 col-lg-4 col-xl-4 col-12 col-sm-12">
			<iframe width="250" height="220" src="{{$course->link}}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			<a href="{{route('admin.course.content.edit', $course->id)}}" class="btn btn-primary float-right"><i class="fa fa-edit"></i></a>
		</div>
	</div>
</div>
@endsection