@extends('layouts.admin-app')
@section('content')
<div class="col-md-12 col-lg-12 col-xl-12 xol-12 sm-12">
	<center><img src="{{asset('asset/crash/'.$image_link->crash_image)}}" height="100" width="100" class="rounded"></center>
	<form hidden="hidden" method="post" action="{{route('admin.course.publish', $image_link->id)}}" id="publishForm">
		{{csrf_field()}}
	</form>
	<form hidden="hidden" method="post" action="{{route('admin.course.revert', $image_link->id)}}" id="reverForm">
		{{csrf_field()}}
	</form>
	<center><h1>Latest Update</h1></center>
	<div>
		@if($image_link->publish == 0) <a href="#" class="btn btn-primary float-right ml-2" id="publish">Publish Now</a> @else <a href="#" class="btn btn-primary float-right ml-2" id="revert">Revert Now</a> @endif
		<a href="{{route('admin.course.getAll', $image_link->id)}}" class="btn btn-info float-right">View All Content</a>
	</div><br>
	@if($courseContent != '')
	<div class="row mt-5">
		<div class="col-md-7 col-lg-7 col-sm-12 col-12">
			<p>
				{!! $courseContent->description!!}
			</p>
		</div>
		<div class="col-md-5 col-lg-5 col-sm-12 col-12">
			<div class="media">
				<div class="media-body">
					<iframe width="300" height="250" src="{{$courseContent->link}}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
	@else
	<a href="#" class="btn btn-primary">Let Start</a>
	@endif
	<hr>
</div>
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<strong><center>Content Addon Form</center></strong>
		</div>
		<div class="card-body">
			<form action="{{route('admin.course.postAdd', $image_link->id)}}" method="post">
				{{csrf_field()}}
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Title</span>
					</div>
					<input type="text" name="title" class="form-control" required="required">
				</div>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Video Link</span>
					</div>
					<input type="text" name="link" class="form-control" required="required" placeholder="Must be entered embadable video link">
				</div>
				<textarea name="description" id="editor1" rows="15" cols="80" required="required">
				</textarea>
				<br>
				<button class="btn btn-primary float-right">Up To Date</button>
			</form>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('ckeditor/ckfinder/ckfinder/ckfinder.js')}}"></script>
<script type="text/javascript">
	// CKEDITOR.replace( 'editor1' );
	var editor = CKEDITOR.replace( 'editor1' );
    CKFinder.setupCKEditor( editor );
	$(document).ready(function(){
		$('#publish').on('click', function(e){
			if(confirm("Are sure want to publish the content of this tutorial, this could not be revertable again")){
				$('#publishForm').submit();
			}
		});
		$('#revert').on('click', function(e){
			if(confirm("Are sure want to revert the content of this tutorial, This will be no longer to public")){
				$('#reverForm').submit();
			}
		});
	});
</script>
@endsection