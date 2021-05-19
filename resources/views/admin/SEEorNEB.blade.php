@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
	@include('partial.success')
	@include('partial.error')
</div>
<div class="row container">
	@if(isset($subjects) && count($subjects)>0)
	<div class="col-md-12">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Question Paper</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">@if(isset($value)) {{$value}} @else NBD @endif</a>
			</li>
		</ul>
	</div>
	<div class="col-md-12">
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<center><strong>Question Paper Upload</strong></center>
				<form action="{{route('SEEorNEB.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="mode" value="1">
					<div class="row">
						<div class="col-md-6">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose Subjects</span>
								</div>
								<select class="form-control js-example-basic-single" name="subject_name">
									<option value="">Choose Subject</option>
									@foreach($subjects as $subject)
									<option value="{{$subject->id}}">
										@if($subject->class==1)
										XI
										@elseif($subject->class==2)
										XII
										@else
										@endif
										{{$subject->subject_name}}
									</option>
									@endforeach
								</select>
							</div>
							@error('subject_name')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-6">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose Year</span>
								</div>
								<select class="form-control js-example-basic-single" name="year">
									<option value="">Choose Year</option>
									@for($i=2050; $i<=$last_date; $i++)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
							</div>
							@error('year')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="card">
						<div class="form-check-inline">
							<label class="form-check-label" for="radio2">
								<input type="radio" class="form-check-input" id="radio2" name="is_regular" value="1" checked="checked">Regular
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="is_regular" value="0">Partial
							</label>
						</div>
					</div>
					<div>
						<input type="file" name="file">
						@error('file')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<button type="submit" class="btn btn-primary float-right btn-sm">Upload</button>
				</form>
				<div>
					<hr class="mt-5">
					<center><strong>Your uploaded Question paper:</strong></center>
					<input type="text" name="search1" id="search1" class="mb-1 float-right" placeholder="search here">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Subject Name</th>
								<th>Year</th>
								<th>way</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody id="tbody-1">
							@if(isset($olds) && count($olds)>0)
							@foreach($olds as $old)
							@if($old->mode==1)
							<tr>
								<td>{{$count++}}</td>
								<td>{{$old->subject_name}}</td>
								<td>{{$old->year}}</td>
								<td>
									@if($old->is_regular==1)
									Regular
									@else
									Partial
									@endif
								</td>
								<td><a href="{{route('SEEorNEB.destroy', $old->id)}}" id="question{{$old->id}}"><i class="fas fa-trash"></i></a>
									<form action="{{route('SEEorNEB.destroy', $old->id)}}" method="post" id="question-destroy{{$old->id}}">
										@csrf
										{{method_field('DELETE')}}
									</form>
								</td>
								<td><a href="#"><i class="fab fa-readme"></i></a></td>
								<td><a href="{{asset('asset/see-neb/'.$old->file_name)}}"><i class="far fa-download"></i></a></td>
							</tr>
							@endif
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
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<center><strong>@if(isset($value)) {{$value}} @else NBD @endif Upload Form</strong></center>
				<form action="{{route('SEEorNEB.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="mode" value="2">
					<div class="row">
						<div class="col-md-6">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose Subjects</span>
								</div>
								<select class="form-control js-example-basic-single" name="subject_name" style="width: 70%;">
									<option value="">Choose Subject</option>
									@foreach($subjects as $subject)
									<option value="{{$subject->id}}">
										@if($subject->class==1)
										XI
										@elseif($subject->class==2)
										XII
										@else
										@endif
										{{$subject->subject_name}}
									</option>
									@endforeach
								</select>
							</div>
							@error('subject_name')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-6">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose Year</span>
								</div>
								<select class="form-control js-example-basic-single" name="year" style="width: 70%;">
									<option value="">Choose Year</option>
									@for($i=2050; $i<=$last_date; $i++)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
							</div>
							@error('year')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose Edition</span>
								</div>
								<select class="form-control js-example-basic-single" name="edition" style="width: 72%;">
									<option value="">Choose Edition</option>
									@for($i=1; $i<=15; $i++)
									<option value="{{$i}}">
										{{$i}}
									</option>
									@endfor
								</select>
							</div>
							@error('edition')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="col-md-6">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Choose Publication</span>
								</div>
								<select class="form-control js-example-basic-single" name="publication" style="width: 60%;">
									<option value="">Choose Year</option>
									<option value="Asmita">Asmita Publication</option>
									<option value="Buddha">Buddha Publication</option>
								</select>
							</div>
							@error('publication')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="card">
						<div class="form-check-inline">
							<label class="form-check-label" for="radio2">
								<input type="radio" class="form-check-input" name="medium" value="1" checked="checked">English Medium
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" class="form-check-input" name="medium" value="0">Nepali Medium
							</label>
						</div>
					</div>
					<div>
						<input type="file" name="file">
						@error('file')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
					</div>
					<button type="submit" class="btn btn-primary float-right btn-sm">Upload</button>
				</form>
				<div>
					<hr class="mt-5">
					<center><strong>Your uploaded {{$value}}:</strong></center>
					<input type="text" name="search2" id="search2" class="mb-1 float-right" placeholder="search here">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th>#</th>
								<th>Subject Name</th>
								<th>Year</th>
								<th>Edition</th>
								<th>Publication</th>
								<th>Medium</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody id="tbody-2">
							@if(isset($olds) && count($olds)>0)
							@foreach($olds as $old)
							@if($old->mode==2)
							<tr>
								<td>{{$c++}}</td>
								<td>{{$old->subject_name}}</td>
								<td>{{$old->year}}</td>
								<td>{{$old->edition}}</td>
								<td>{{$old->publication}}</td>
								<td>
									@if($old->medium==1)
									English
									@else
									Nepali
									@endif
								</td>
								<td><a href="{{route('SEEorNEB.destroy', $old->id)}}" id="guess{{$old->id}}"><i class="fas fa-trash"></i></a>
									<form action="{{route('SEEorNEB.destroy', $old->id)}}" method="post" id="guess-destroy{{$old->id}}">
										@csrf
										{{method_field('DELETE')}}
									</form>
								</td>
								<td><a href="#"><i class="fab fa-readme"></i></a></td>
								<td><a href="{{asset('asset/see-neb/'.$old->file_name)}}"><i class="far fa-download"></i></a></td>
							</tr>
							@endif
							@endforeach
							@else
							<tr>
								<td colspan="7"><center>Record not found</center></td>
							</tr>
							@endif
						</tbody>
					</table>
					{{$olds->links()}}
				</div>
			</div>
		</div>
	</div>
	@else
	<center><strong>Not Available for you</strong></center>
	@endif
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection
@section('scripts')
<script type="text/javascript">
	$('#myTab a').on('click', function (e) {
e.preventDefault()
$(this).tab('show')
})
$(document).ready(function() {
$('.js-example-basic-single').select2();
@if(isset($olds) && count($olds)>0)
@foreach($olds as $old)
$('#guess{{$old->id}}').on('click', function(event){
	event.preventDefault();
	$('#guess-destroy{{$old->id}}').submit();
});
$('#question{{$old->id}}').on('click', function(event){
	event.preventDefault();
	$('#question-destroy{{$old->id}}').submit();
});
@endforeach
@endif

         function fetch_data(query='', level_id='')
         {
         	$.ajax({
         		 url:'{{route("live.search1")}}',
         		 method:'get',
         		 data:{query1:query, level_id:level_id},
         		 dataType:'json',
         		 success:function(data)
         		 {
         		 	// console.log(data);	
         		 	$('#tbody-1').html(data.table_data);
         		 },
         		 error: function(e) {
                  console.log(e);
                 }

         	});
         }

    $(document).on('keyup', '#search1', function(){
         var query=$(this).val();
         var level_id={{$level_id}};
         console.log(query);
         fetch_data(query, level_id);
      });


     function fetch_data1(query='', level_id='', mode='')
         {
         	$.ajax({
         		 url:'{{route("live.search2")}}',
         		 method:'get',
         		 data:{query1:query, level_id:level_id, mode:mode},
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

    $(document).on('keyup', '#search2', function(){
         var query=$(this).val();
         var level_id={{$level_id}};
         console.log(query);
         fetch_data1(query, level_id, 2);
      });



});
</script>
@endsection