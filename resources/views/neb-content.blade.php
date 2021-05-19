@extends('layouts.app')
@section('content')
<?php 

use App\Help\NepaliDate;
use Illuminate\Support\Facades\Storage;
  $nepali_date= new NepaliDate();
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
@if(isset($nebContents) && count($nebContents)>0)
<div class="row">
	<div class="col-md-12 col-lg-12 col-xl-12 col-12 col-sm-12">
  		<div class="float-right">
  			<div class="input-group input-group-sm mb-3">
			    <div class="input-group-prepend">
			    	<span class="input-group-text" id="basic-addon1">Sort By</span>
			    </div>
			    <select name="Sort">
			    	<option>Newest</option>
			    	<option>Oldest</option>
			    </select>
		    </div>
  		</div>
  	</div>

  	<div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
  		    <h5><u>Class XI ({{$faculty_name}}) @if($mode==1) Question Paper @else Guess Paper @endif</u></h5>
  				@foreach($nebContents as $nebContent)
  		            @if($nebContent->class == 1)
  		            <label class="container1" id="quick-label{{$nebContent->id}}">
                      <img src="{{asset('asset/image1/pdf.PNG')}}" style="height: 100" width="100" id="image{{$nebContent->id}}">
                      <div class="bottom-content"><a id="modalActivate" href="#" data-toggle="modal" data-target="#exampleModalPreview" class="btn btn-primary btn-sm btn-read quick-read pdf-content{{$nebContent->id}} read-now{{$nebContent->id}}" file_name="{{asset('asset/see-neb/'.$nebContent->file_name)}}">Read</a></div>
                      <div>
                        <a href="#">{{$nebContent->subject_name}}</a>
                      </div>
                      <div>{{$nebContent->year}}({{$nepali_date->get_eng_year($nebContent->year, 1, 1)}})<a href="{{asset('asset/see-neb/'.$nebContent->file_name)}}"><i class="fas fa-download"></i></a></div>
                  </label>
                  @else
                   <div id="sorry-content1"></div>
  		            @endif
  		    @endforeach
  	</div>
  	<div class="col-md-6 col-lg-6 col-xl-6 col-12 col-sm-12">
  		<h5><u>Class XII ({{$faculty_name}}) @if($mode==1) Question Paper @else Guess Paper @endif</u></h5>
  				@foreach($nebContents as $nebContent)
  		            @if($nebContent->class == 2)
  		            <label class="container1" id="quick-label{{$nebContent->id}}">
                      <img src="{{asset('asset/image1/pdf.PNG')}}" style="height: 100" width="100" id="image{{$nebContent->id}}">
                      <div class="bottom-content"><a id="modalActivate" href="#" data-toggle="modal" data-target="#exampleModalPreview" class="btn btn-primary btn-sm btn-read quick-read pdf-content{{$nebContent->id}} read-now{{$nebContent->id}}" file_name="{{asset('asset/see-neb/'.$nebContent->file_name)}}">Read</a></div>
                      <div>
                        {{$nebContent->subject_name}}
                      </div>
                      <div>{{$nebContent->year}}({{$nepali_date->get_eng_year($nebContent->year, 1, 1)}})<a href="{{asset('asset/see-neb/'.$nebContent->file_name)}}"><i class="fas fa-download"></i></a></div>
                  </label>
                  @else
                   <div id="sorry-content2"></div>
  		            @endif
  		        @endforeach
  	</div>
  	<div class="col-md-12 col-lg-12 col-xl-12 col-12 col-sm-12">
  		<center>{{$nebContents->links()}}</center>
  	</div>
</div>
<hr style="border-color: #0000005c;">
@endif
<div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe style="float:right;" src = "" width='100%' height='720' allowfullscreen webkitallowfullscreen id="pdf-reader"></iframe>
            </div>
            <div class="modal-footer-full-width  modal-footer">
               
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
 <script type="text/javascript">
   $(document).ready(function(){
    var data="<h5>Sorry !!</h5><label>This content will be available as soon as possible</label>";
      @if(isset($nebContents) && count($nebContents)>0)
        @foreach($nebContents as $nebContent)
           $('#quick-label{{$nebContent->id}}').hover(function(){
                // alert();
                $('.read-now{{$nebContent->id}}').removeClass('quick-read');
                $('#image{{$nebContent->id}}').addClass('zoom')
                $('.read-now{{$nebContent->id}}').addClass('animate__animated  animate__zoomIn');
            }, function(){
                 $('.read-now{{$nebContent->id}}').removeClass('animate__animated  animate__zoomIn');
                 $('.read-now{{$nebContent->id}}').addClass('quick-read');
                 $('#image{{$nebContent->id}}').removeClass('zoom')
            });
           @if($nebContent->class != 1)
               $('#sorry-content1').html(data);
           @elseif($nebContent->class !== 2)
                $('#sorry-content2').html(data);
           @endif
        $('.read-now{{$nebContent->id}}').on('click', function(event){
            event.preventDefault();
            $('#pdf-reader').attr('src', $(this).attr('file_name'));
        });
        @endforeach
      @endif
   });
 </script>
@endsection