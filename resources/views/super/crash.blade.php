@extends('layouts.super-app')
@section('content')
<div class="col-md-12">
	@include('partial.success')
	@include('partial.error')
</div>
<div class="row container">
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<center><strong>Crash Course</strong></center>
			</div>
			<div class="card-body">
				<form method="{{$method}}" action="{{$action}}" enctype="multipart/form-data">
					@csrf
					@if($check)
				     {{method_field('PATCH')}}
					@endif
					<div class="input-group input-group-sm mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Name</span>
						</div>
						<input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="crash_name" value="{{ old('crash_name', $crash->crash_name) }}">
					</div>
					@error('crash_name')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="image-upload">
						<label for="file-input">
							<img src="{{asset('asset/crash/'.$crash->crash_image)}}" id="profile_image" width="150px" height="150px;">
						</label>
						<input id="file-input" type="file" name="crash_image"/>
					</div>
					@error('crash_image')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="input-group input-group-sm mb-3 mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Description</span>
						</div>
						<textarea name="description" rows="5">{{ old('description', $crash->description) }}</textarea>
					</div>
					@error('desciption')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<button type="submit" class="btn btn-primary btn-sm float-right">{{$btn_text}}</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th colspan="4">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($crashes) && count($crashes)>0)
				@foreach($crashes as $crash)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$crash->crash_name}}</td>
					<td><a href="{{route('crash.show', $crash)}}"><i class="fas fa-edit"></i></a></td>
					<td><a href="#" id="delete{{$crash->id}}"><i class="fas fa-trash"></i></a>
						<form method="post" id="destroy{{$crash->id}}" hidden="hidden" action="{{route('crash.destroy', $crash)}}">
							@csrf
							{{method_field('DELETE')}}
						</form></td>
						<td>
							@if($crash->assign==0)
							<a href="#" id="assign{{$crash->id}}" crash_id="{{$crash->id}}"  data-toggle="modal" data-target="#exampleModalLong">Assign</a>
							@else
							Assigned
							@endif
						</td>
					<td><a href="#"><i class="fas fa-eye"></i></a></td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<form action="{{route('crash.assign')}}" method="post">
			@csrf
			<input type="hidden" name="crash_id" id="crash_id">
			<div class="modal-body">
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Choose a Subject</span>
					</div>
					<select class="form-control" name="admin_id">
						<option value="">Choose an admins</option>
						@if(isset($admins) && count($admins)>0)
						@foreach($admins as $admin)
						<option value="{{$admin->id}}">{{$admin->name}}</option>
						@endforeach
						@else
						<option value="">No Admins  available; first add some admins</option>
						@endif
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Assign</button>
			</div>
		</form>
	</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	 $('#file-input').change(function(evt) {
        $('#image_upload').removeAttr('hidden');
        readURL(this);
    });
	 function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
        @if(isset($crashes) && count($crashes)>0)
	    @foreach($crashes as $crash)
	     $('#delete{{$crash->id}}').on('click', function(event){
	     	event.preventDefault();
	     	$('#destroy{{$crash->id}}').submit()
	     });
	     $('#assign{{$crash->id}}').on('click', function(event){
			event.preventDefault();
			$('#crash_id').val($(this).attr('crash_id'));
		});
	    @endforeach
	    @endif
</script>
@endsection