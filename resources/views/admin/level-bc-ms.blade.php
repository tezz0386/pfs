@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
	@include('partial.success')
	@include('partial.error')
</div>
<div class="container">
	<input type="text" name="search" class="float-right mb-1 mr-3" placeholder="search here" id="search">
</div>
<div class="row container">
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th>#</th>
				<th>Subject</th>
				<th>Subject Code</th>
				<th></th>
				<th>Program</th>
				<th>University</th>
				<th>Faculty</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="tbody-2">
			@if(isset($universitySubjects) && count($universitySubjects)>0)
			@foreach($universitySubjects as $universitySubject)
			<tr>
				<td>{{$n++}}</td>
				<td>{{$universitySubject->subject_name}}</td>
				<td>{{$universitySubject->subject_code}}</td>
				<td>
					@if($universitySubject->ways==1)
					{{$universitySubject->year_name}} Year
					@else
					{{$universitySubject->year_name}} Semester
					@endif
				</td>
				<td>{{$universitySubject->program_name}}</td>
				<td>{{$universitySubject->university_name}}</td>
				<td>{{$universitySubject->faculty_name}}</td>
				<td>
					<a href="{{route('BCorMS.upload', $universitySubject->id)}}"><i class="fas fa-upload"></i></a>
				</td>
			</tr>
			@endforeach
			@else
			<tr>
				<td colspan="8"><center>Not available for you</center></td>
			</tr>
			@endif
		</tbody>
	</table>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		 function fetch_data(query='', level_id='')
         {
         	$.ajax({
         		 url:'{{route("BCorMS.search")}}',
         		 method:'get',
         		 data:{query1:query, level_id:level_id},
         		 dataType:'json',
         		 success:function(data)
         		 {
         		 	// console.log(data);	
         		 	$('#tbody-2').html(data.table_data);
         		 },
         		 error: function(e) {
                  console.log(e);
                 }

         	});
         }

        $(document).on('keyup', '#search', function(){
         var query=$(this).val();
         var level_id={{$level_id}}
         // console.log(query);
         fetch_data(query, level_id);
        });
	});
</script>
@endsection