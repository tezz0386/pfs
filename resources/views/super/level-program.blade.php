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
				<center><strong>Program Adden Form</strong></center>
				<center><label>Level: {{$level->level_name}}</label></center>
			</div>
			<div class="card-body">
				<form action="{{route('level.postProgram', $level)}}" method="post">
					@csrf
					<div class="input-group input-group-sm mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Choose University</span>
						</div>
						<select class="form-control" name="university_id">
							<option value="">Choose a University</option>
							@if(isset($universities) && count($universities)>0)
							@foreach($universities as $university)
							<option value="{{$university->id}}">{{$university->university_name}}</option>
							@endforeach
						    @endif
						</select>
					</div>
					@error('university_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
					<div class="input-group input-group-sm mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Choose Faculty</span>
						</div>
						<select class="form-control" name="faculty_id">
							<option value="">Choose a Faculty</option>
							@if(isset($faculties) && count($faculties)>0)
							@foreach($faculties as $faculty)
							<option value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
							@endforeach
						    @endif
						</select>
					</div>
					@error('faculty_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
					<div class="input-group input-group-sm mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Choose Program</span>
						</div>
						<select class="form-control" name="program_id">
							<option value="">Choose a Program</option>
							@if(isset($programs) && count($programs)>0)
							@foreach($programs as $program)
							<option value="{{$program->id}}">{{$program->program_name}}</option>
							@endforeach
						    @endif
						</select>
					</div>
					@error('program_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
					<div class="card card-body">
						<div class="row">
							<div class="col-md-6">
								<label><input type="radio" name="ways" checked="checked" value="1"> Year Ways</label>
							</div>
							<div class="col-md-6">
								<label><input type="radio" name="ways" value="2"> Semester Ways</label>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-sm float-right">submit</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<center><strong>Program List</strong></center>
			</div>
			<div class="card">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Program Name</th>
							<th>Faculty</th>
							<th>University Name</th>
							<th>Level</th>
							<th>Ways</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($all) && count($all)>0)
						@foreach($all as $single)
						<tr>
							<td>{{$i++}}</td>
							<td>{{$single->program_name}}</td>
							<td>{{$single->faculty_name}}</td>
							<td>{{$single->university_name}}</td>
							<td>{{$single->level_name}}</td>
							<td>
								@if($single->ways==2)
								Semester
								@else
								Year
								@endif

							</td>
							<td><a href="#" id="destroy{{$single->id}}"><i class="fas fa-trash"></i></a>
								  <form hidden="hidden" method="post" action="{{route('level.destroyProgram', $single->id)}}" id="delete{{$single->id}}">@csrf{{ method_field('DELETE') }}</form>
							</td>
							<td><a href="{{route('level.getSubProgram', $single->id)}}"><i class="fas fa-eye"></i></a></td>
						</tr>
						@endforeach
						@else
						<tr>
							<td colspan="7"><center>Record not found</center></td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
     $(document).ready(function(){
      @if(isset($all) && count($all)>0)
      @foreach($all as $single)
        $('#destroy{{$single->id}}').on('click', function(event){
            event.preventDefault();
            $('#delete{{$single->id}}').submit();
        });
      @endforeach
      @endif
     });
</script>
@endsection