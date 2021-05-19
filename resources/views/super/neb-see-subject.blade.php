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
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<center><strong>Subject Registration Form</strong></center>
					</div>
					<div class="card-body">
						<center><strong>Level: {{$level->level_name}}</strong></center>
						<form action="{{route('level.postNebOrSeeSubProgram', $level)}}" method="post" class="mt-2">
							@csrf
							@if(isset($faculties) && count($faculties)>0)
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose a Faculties</span>
								</div>
								<select class="form-control js-example-basic-single" name="faculty_name">
									<option value="">Choose a Faculty</option>
									@foreach($faculties as $faculty)
									<option value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
									@endforeach
								</select>
							</div>
							@endif
							@error('faculty_name')
							<div class="alert alert-danger">{{$message}}</div>
							@enderror
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
							<div class="alert alert-danger">{{$message}}</div>
							@enderror
							@if(isset($class_check))
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose a Class</span>
								</div>
								<select class="form-control" name="class">
									<option value="">Choose a Class</option>
									<option value="1">XI</option>
									<option value="2">XII</option>
								</select>
							</div>
							@error('class')
							<div class="alert alert-danger">{{$message}}</div>
							@enderror
							@endif
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Subject Code</span>
								</div>
								<input type="text" name="subject_code" class="form-control" required="required">
							</div>
							@error('subject_code')
							<div class="alert alert-danger">{{$message}}</div>
							@enderror
							<button class="btn btn-sm btn-primary float-right" type="submit">Add</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<center><strong>Subject List on : </strong></center>
					</div>
					<div class="card-body">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Code</th>
									@if(isset($class_check))
									<th>Class</th>
									<th>Faculty</th>
									@endif
									<th colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
								@if(isset($seeOrNebSubjects) && count($seeOrNebSubjects)>0)
								@foreach($seeOrNebSubjects as $seeOrNebSubject)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$seeOrNebSubject->subject_name}}</td>
									<td>{{$seeOrNebSubject->subject_code}}</td>
									@if(isset($class_check))
									<td>
										@if($seeOrNebSubject->class==1)
										XI
										@else
										XII
										@endif
									</td>
									<td>{{$seeOrNebSubject->faculty_name}}</td>
									@endif
									<td>
										<a href="#" id="destroy{{$seeOrNebSubject->id}}"><i class="fas fa-trash"></i></a>
									<form hidden="hidden" method="post" action="{{route('level.destroySeeOrNebSubject', $seeOrNebSubject->id)}}" id="delete{{$seeOrNebSubject->id}}">@csrf{{ method_field('DELETE') }}</form>
								</td>
								<td>
									@if($seeOrNebSubject->assign==0)
									<a href="#" data-toggle="modal" data-target="#exampleModalLong" id="assign{{$seeOrNebSubject->id}}" assistant_id="{{$seeOrNebSubject->id}}">Assign</a>
									@else
									Assigned
									@endif
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
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
		<form action="{{route('level.postAssignSeeOrNebSubject')}}" method="post" style="width: 100%;">
			@csrf
			<input type="hidden" name="subjectAssistant_id" id="subjectAssistant_id">
			<div class="modal-body">
				<div class="input-group input-group-sm mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Choose an admin</span>
					</div>
					<select class="form-control js-example-basic-single" name="admin_id" style="width: 60%;">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		@if(isset($seeOrNebSubjects) && count($seeOrNebSubjects))
		@foreach($seeOrNebSubjects as $seeOrNebSubject)
		$('#assign{{$seeOrNebSubject->id}}').on('click', function(event){
			event.preventDefault();
				$('#subjectAssistant_id').val($(this).attr('assistant_id'));
		});
		 $('#destroy{{$seeOrNebSubject->id}}').on('click', function(event){
            event.preventDefault();
            $('#delete{{$seeOrNebSubject->id}}').submit();
           });
		@endforeach
		@endif
		$('.js-example-basic-single').select2();
	})
</script>
@endsection