@extends('layouts.super-app')
@section('content')
<div class="row">
	<div class="col-md-12">
		@include('partial.success')
		@include('partial.error')
	</div>
</div>
<div class="row container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<center><strong>Subject Registration</strong></center>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<strong><label> University: @if(isset($university_name)) {{$university_name->university_name}} @endif</label></strong>
						</div>
						<div class="row">
							<strong><label> Program: @if(isset($faculty_name)) {{$faculty_name->faculty_name}} @endif</label></strong>
						</div>
						<div class="row">
							<strong><label>Level: @if(isset($level_name)) {{$level_name->level_name}} @endif</label></strong>
						</div>
						<div class="row">
							<strong><label> Program: @if(isset($program_name)) {{$program_name->program_name}} @endif</label></strong>
						</div>
					</div>
					<div class="col-md-6">
						<form action="{{route('level.postSubProgram', $assistant_id)}}" method="post">
							@csrf
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose a Subject</span>
								</div>
								<select class="form-control js-example-basic-single" name="subject_name">
									<option value="">Choose a Subject</option>
									@if(isset($subjects) && count($subjects)>0)
									@foreach($subjects as $subject)
									<option value="{{$subject->id}}">{{$subject->subject_name}}</option>
									@endforeach
									@else
									<option value="">No subejects available; first add some subject</option>
									@endif
								</select>
							</div>
							@error('subject_name')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Subject Code</span>
								</div>
								<input type="text" name="subject_code" class="form-control">
							</div>
							@error('subject_code')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
							@if(isset($ways) && $ways==1)
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose a Year</span>
								</div>
								<select class="form-control" name="year_name">
									<option value="">Choose a Year</option>
									@if(isset($years) && count($years)>0)
									@foreach($years as $year)
									<option value="{{$year->id}}">{{$year->year_name}} Year</option>
									@endforeach
									@else
									<option value="">No subejects available; first add some subject</option>
									@endif
								</select>
							</div>
							@else
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose a Semester</span>
								</div>
								<select class="form-control" name="year_name">
									<option value="">Choose a Semester</option>
									@if(isset($years) && count($years)>0)
									@foreach($years as $year)
									<option value="{{$year->id}}">{{$year->year_name}} Semester</option>
									@endforeach
									@else
									<option value="">No Years/Semester available; first add some Years/Semester</option>
									@endif
								</select>
							</div>
							@endif
							@error('year_name')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
							<button type="submit" class="float-right btn btn-primary btn-sm">Add</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<center><strong>Registered subject</strong></center>
			</div>
			<div class="card-body">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Subject Nmae:</th>
							<th>Subject Code</th>
							<th>@if(isset($ways) && $ways==1) Year @else Semester @endif</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($subjectAssistants) && count($subjectAssistants))
						@foreach($subjectAssistants as $subjectAssistant)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$subjectAssistant->subject_name}}</td>
							<td>{{$subjectAssistant->subject_code}}</td>
							<td>{{$subjectAssistant->year_name}}</td>
							<td><a href="#" id="destroy{{$subjectAssistant->id}}"><i class="fas fa-trash"></i></a>
								 <form hidden="hidden" method="post" action="{{route('level.destroySubject', $subjectAssistant->id)}}" id="delete{{$subjectAssistant->id}}">@csrf{{ method_field('DELETE') }}</form>
							</td>
							<td>
								@if($subjectAssistant->assign == 0)
								<a href="#"data-toggle="modal" data-target="#exampleModalLong" id="assign{{$subjectAssistant->id}}" assistant_id="{{$subjectAssistant->id}}'">Assign</a>
								@else
								Assigned
								@endif
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td colspan="6"><center>Record not found</center></td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
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
				<form action="{{route('level.postAssignSubject')}}" method="post">
					@csrf
					<input type="hidden" name="subjectAssistant_id" id="subjectAssistant_id">
					<div class="modal-body">
						<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose a Admin</span>
								</div>
								<select class="form-control js-example-basic-single" name="admin_id">
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
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
  	$(document).ready(function(){
  		@if(isset($subjectAssistants) && count($subjectAssistants))
		@foreach($subjectAssistants as $subjectAssistant)
		  $('#assign{{$subjectAssistant->id}}').on('click', function(event){
		  	event.preventDefault();
		  		$('#subjectAssistant_id').val($(this).attr('assistant_id'));
		  });
		   $('#destroy{{$subjectAssistant->id}}').on('click', function(event){
            event.preventDefault();
            $('#delete{{$subjectAssistant->id}}').submit();
           });
		@endforeach
		@endif
		$('.js-example-basic-single').select2();
  	})
  </script>
@endsection