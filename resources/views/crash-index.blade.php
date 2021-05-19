@extends('layouts.app')
@section('content')
      <div class="row">
      	<div class="col-md-3 col-lg-3 col-sm-12 col-xl-3 col-12 menu-div" style="overflow-x: hidden;" id="course-nav">
      		@if(isset($crash) && $crash != '')
      		<center><img src="{{asset('asset/crash/'.$crash->crash_image)}}" height="100" width="100"></center>
      		<center><strong>Tutorials of {{$crash->crash_name}}</strong></center>
      		@endif
      		<hr style="border-color: #0000005c">
      		@if(isset($courses) && count($courses)>0)
      		 <ul class="list-unstyled">
      		 	@foreach($courses as $course)
      		 	<li  @if(isset($checkTitle) && $checkTitle=='checkTitle'.$course->id) class="activeMode" @endif ><a href="{{route('getCrashCourse', $course->id)}}">{{$course->title}}</a></li>
      		 	@endforeach
      		 </ul>
      		@endif
      	</div>
      	<div class="col-md-7 col-lg-7 col-xl-7 xol-12" style="overflow-x: hidden; height: 700px">
      		 @if(isset($courseContent) && $courseContent != '') {!!$courseContent->description!!} @endif
      		 @if(isset($min) && $min->id != $courseContent->id)
      		 <a href="{{route('previousPage', ['crash_id'=>$crash->id, 'course_id'=>$courseContent->id])}}" class="btn btn-sm btn-info"><< Previuos Page</a>
      		 @endif
      		 @if(isset($max) && $max->id != $courseContent->id)
      		 <a href="{{route('nextPage', ['crash_id'=>$crash->id, 'course_id'=>$courseContent->id])}}" class="btn btn-primary float-right btn-sm">Next Page >></a>
      		 @endif
      	</div>
      	<div class="col-md-2 col-lg-2 col-sm-12 col-xl-2 col-12">
      		<center><strong>Learn Form Video</strong></center>
      		<center><iframe width="140" height="120" src="{{$courseContent->link}}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
      	</div>
      </div>
@endsection