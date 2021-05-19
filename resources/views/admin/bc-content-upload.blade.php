@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
	@include('partial.success')
	@include('partial.error')
</div>
<div class="row container">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<center><strong>Content Upload Form</strong></center>
			</div>
			<div class="card-body">
				@if(isset($details) && count($details)>0)
				@foreach($details as $detail)
				<div class="row">
					<div class="col-md-6">
						<label>University : {{$detail->university_name}}</label><br>
						<label>Faculty : {{$detail->faculty_name}}</label><br>
						<label>Program : {{$detail->program_name}}</label><br>
					</div>
					<div class="col-md-6">
						<label>@if($detail->ways==1) Year @else Semester @endif : {{$detail->year_name}} @if($detail->ways==1) Year @else Semester @endif</label><br>
						<label>Subject : {{$detail->subject_name}}</label><br>
						<label>Subject Code : {{$detail->subject_code}}</label><br>
					</div>
				</div>
				@endforeach
				@endif
				<div class="row mt-3">
					<form action="{{route('BCorMS.store')}}" method="post" style="width: 100%;" enctype="multipart/form-data">
						
				        <input type="hidden" name="assistant_id" value="{{$assistant_id}}">
						@error('edition')
						<div class="alert alert-danger">{{ $message }}
						</div>
						@enderror
						@error('publication')
						<div class="alert alert-danger">{{ $message }}
						</div>
						@enderror
						@csrf
						<div class="col-md-12">
							<div class="row">
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
									<input type="file" name="file_name">
									@error('file_name')
									<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="col-md-6">
									<label>Mode</label><br>
									<label>
										<input type="radio" name="mode" checked="checked" value="1"> Question Paper
									</label><br>
									<label>
										<input type="radio" name="mode" value="2"> Note
									</label><br>
									<label>
										<input type="radio" name="mode" value="3"> Guess Paper
									</label>
								</div>
								<div class="row" id="my-row" style="width: 100%">
									
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-sm float-right">Upload</button>
					</form>
				</div>
				<div class="row mt-5">
					<div class="col-md-12">
						<div class="row">
							<a href="{{route('BCorMS.list', [0, 'assistant_id'=>$assistant_id])}}" class="btn btn-primary">All</a>
							<a href="{{route('BCorMS.list', [1, 'assistant_id'=>$assistant_id])}}" class="btn btn-primary">Question Paper</a>
							<a href="{{route('BCorMS.list', [2, 'assistant_id'=>$assistant_id])}}" class="btn btn-primary">Note</a>
							<a href="{{route('BCorMS.list', [3, 'assistant_id'=>$assistant_id])}}" class="btn btn-primary">Guess Paper</a>
							<input type="text" name="search" id="search" class="float-right" placeholder="search here">
						</div>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Year</th>
								<th>Type</th>
								<th>Medium</th>
								<th>Publication</th>
								<th>Edition</th>
								<th colspan="3">Action</th>
							</tr>
						</thead>
						<tbody id="tbody-1">
							@if(isset($contents) && count($contents)>0)
							@foreach($contents as $content)
							<tr>
								<td>{{$n++}}</td>
								<td>{{$content->year}}</td>
								<td>@if($content->mode==1) Question Paper @elseif($content->mode==2)Note @elseif($content->mode==3) Guess Paper @endif</td>
								<td>@if($content->medium==1)English Medium @elseif($content->medium==2)Nepali Medium @else English Medium @endif</td>
								<td>{{$content->publication}}</td>
								<td>{{$content->edition}}</td>
								<td><a href="#" id="destroyLink{{$content->id}}"><i class="fas fa-trash"></i></a>
									<form hidden="hidden" action="{{route('BCorMS.destroy', $content)}}" method="post" id="destroyForm{{$content->id}}">
										@csrf
										@method('DELETE')
									</form>
								</td>
								<td><a href="#"><i class="fab fa-readme"></i></a></td>
								<td><a href="{{asset('asset/bc-ms/'.$content->file_name)}}"><i class="fas fa-download"></i></a></td>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
$('.js-example-basic-single').select2();
var radios = document.querySelectorAll('input[type=radio][name="mode"]');
var myHtml ="";
function changeHandler(event) {
if ( this.value == 1 ) {
// console.log('value', 1);
myHtml ="";
} else if ( this.value == 2 ) {
	myHtml ='<div class="col-md-6"><div class="card card-body"> <label><input type="radio" name="medium" value="1" checked="checked"/> English Medium</label><label><input type="radio" name="medium" value="2"/> Nepali Medium</label></div></div>';
console.log('value', 2);
}  else if(this.value== 3) {
	// console.log('value', 3);
	 myHtml= '<div class="col-md-6"><div class="input-group input-group-sm mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Choose Edition</span></div><select class="form-control js-example-basic-single" name="edition" style="width: 72%;"><option value="">Choose Edition</option>												@for($i=1; $i<=15; $i++)<option  value="{{$i}}">													{{$i}}</option>@endfor</select></div>									</div><div class="col-md-6"><div class="input-group input-group-sm mb-3">											<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Choose Publication</span></div><select class="form-control js-example-basic-single" name="publication" style="width: 60%;">												<option value="">Choose Publication</option>												<option value="Asmita">Asmita Publication</option>												<option value="Buddha">Buddha Publication</option>											</select></div></div><div class="col-md-6"><div class="card card-body"> <label><input type="radio" name="medium" value="1" checked="checked"/> English Medium</label><label><input type="radio" name="medium" value="2"/> Nepali Medium</label></div></div>'
} else{
	console.log("error occured");
}
 $('#my-row').html(myHtml);
}
Array.prototype.forEach.call(radios, function(radio) {
radio.addEventListener('change', changeHandler);
});

        function fetch_data(query='')
        {
        	var assistant_id={{$assistant_id}};
            var mode = {{$mode}};
         	$.ajax({
         		 url:'{{route("BCorMS.list.search")}}',
         		 method:'get',
         		 data:{query1:query, assistant_id:assistant_id, mode:mode},
         		 dataType:'json',
         		 success:function(data)
         		 {
         		 	console.log(data);	
         		 	$('#tbody-1').html(data.table_data);
         		 },
         		 error: function(e) {
                  console.log(e);
                 }

         	});
         }

        $(document).on('keyup', '#search', function(){
         var query=$(this).val();
         console.log(query);
         fetch_data(query);
        });
        
        @if(isset($contents) && count($contents)>0)
        @foreach($contents as $content)
        {
        	$('#destroyLink{{$content->id}}').on('click', function(event)
        	{
        		event.preventDefault();
        		$('#destroyForm{{$content->id}}').submit();
        	})
        }
        @endforeach
        @endif

});
</script>
@endsection