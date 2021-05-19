@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<strong><center>Content Update Form</center></strong>
		</div>
		<div class="card-body">
			<form action="{{route('admin.course.content.editPost', $course)}}" method="post">
				{{method_field('PATCH')}}
				{{csrf_field()}}
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Title</span>
					</div>
					<input type="text" name="title" class="form-control" required="required" value="{{$course->title}}">
				</div>
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Video Link</span>
					</div>
					<input type="text" name="link" class="form-control" required="required" placeholder="Must be entered embadable video link" value="{{$course->link}}">
				</div>
				<textarea name="description" id="editor1" rows="15" cols="80" required="required">
					{{$course->description}}
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
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
@endsection