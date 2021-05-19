@extends('layouts.app')
@section('content')
<?php 

use App\Help\NepaliDate;
use Illuminate\Support\Facades\Storage;
  $nepali_date= new NepaliDate();
 ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
@if(isset($contents3) && count($contents3)>0)
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
    <h6><u>NEB</u></h6>
    <div class="row">
      <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
      @if(isset($faculties) && count($faculties)>0)
      @foreach($faculties as $faculty)
        <h6 id="xi-old-faculty{{$faculty->id}}"><u></u></h6>
      @foreach($contents3 as $content3)
          @if($content3->class == 1 && $content3->faculty_id == $faculty->id)
                  <label class="container1" id="quick-label{{$content3->id}}">
                      <img src="{{asset('asset/image1/pdf.PNG')}}" style="height: 100" width="100" id="image{{$content3->id}}">
                      <div class="bottom-content"><a id="modalActivate" href="#" data-toggle="modal" data-target="#exampleModalPreview" class="btn btn-primary btn-sm btn-read quick-read pdf-content{{$content3->id}} read-now{{$content3->id}}" file_name="{{asset('asset/see-neb/'.$content3->file_name)}}">Read</a></div>
                      <div>
                        <a href="#">{{$content3->subject_name}}</a>
                      </div>
                      <div>{{$content3->year}}({{$nepali_date->get_eng_year($content3->year, 1, 1)}})<a href="{{asset('asset/see-neb/'.$content3->file_name)}}"><i class="fas fa-download"></i></a></div>
                  </label>
          @endif
      @endforeach
      @endforeach
      @endif
      </div>

      <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
      @if(isset($faculties) && count($faculties)>0)
      @foreach($faculties as $faculty)
        <h6 id="xii-old-faculty{{$faculty->id}}"><u></u></h6>
      @foreach($contents3 as $content3)
          @if($content3->class == 2 && $content3->faculty_id == $faculty->id)
                  <label class="container1" id="quick-label{{$content3->id}}">
                      <img src="{{asset('asset/image1/pdf.PNG')}}" style="height: 100" width="100" id="image{{$content3->id}}">
                      <div class="bottom-content"><a id="modalActivate" href="#" data-toggle="modal" data-target="#exampleModalPreview" class="btn btn-primary btn-sm btn-read quick-read pdf-content{{$content3->id}} read-now{{$content3->id}}" file_name="{{asset('asset/see-neb/'.$content3->file_name)}}">Read</a></div>
                      <div>
                        <a href="#">{{$content3->subject_name}}</a>
                      </div>
                      <div>{{$content3->year}}({{$nepali_date->get_eng_year($content3->year, 1, 1)}})<a href="{{asset('asset/see-neb/'.$content3->file_name)}}"><i class="fas fa-download"></i></a></div>
                  </label>
          @endif
      @endforeach
      @endforeach
      @endif
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12 col-12 col-sm-12">
    <center><a href="#">< Show All ></a></center>
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
    @if(isset($faculties) && count($faculties)>0)
    @foreach($faculties as $faculty)
    @if(isset($contents3) && count($contents3)>0)
    @foreach($contents3 as $content3)
     $('.pdf-content3{{$content3->id}}').on('click', function(event)
          {
            event.preventDefault();
            var file_name=$(this).attr('file_name');
            // console.log(file_name);
            $('#pdf-reader').attr('src', file_name);
          });
     @if($content3->mode==1 && $content3->class == 1 && $content3->faculty_id == $faculty->id)
       $('#xi-old-faculty{{$faculty->id}}').html('<a href="#"><u>XI({{$faculty->faculty_name}})Old Question Paper</a></u>');
     @elseif($content3->mode==1 && $content3->class == 2 && $content3->faculty_id == $faculty->id)
     $('#xii-old-faculty{{$faculty->id}}').html('<a href="#"><u>XII({{$faculty->faculty_name}})Old Question Paper</a></u>');
      @elseif($content3->mode==2 && $content3->class == 1 && $content3->faculty_id == $faculty->id)
     $('#xi-old-faculty{{$faculty->id}}').html('<a href="#"><u>XI({{$faculty->faculty_name}})Guess Paper</a></u>');
     @elseif($content3->mode==2 && $content3->class == 2 && $content3->faculty_id == $faculty->id)
     $('#xii-old-faculty{{$faculty->id}}').html('<a href="#"><u>XII({{$faculty->faculty_name}})Guess Paper</a></u>');
     @endif


            $('#quick-label{{$content3->id}}').hover(function(){
                // alert();
                $('.read-now{{$content3->id}}').removeClass('quick-read');
                $('#image{{$content3->id}}').addClass('zoom')
                $('.read-now{{$content3->id}}').addClass('animate__animated  animate__zoomIn');
            }, function(){
                 $('.read-now{{$content3->id}}').removeClass('animate__animated  animate__zoomIn');
                 $('.read-now{{$content3->id}}').addClass('quick-read');
                 $('#image{{$content3->id}}').removeClass('zoom')
            });
        $('.read-now{{$content3->id}}').on('click', function(event){
            event.preventDefault();
            $('#pdf-reader').attr('src', $(this).attr('file_name'));
        });



    @endforeach
    @endif
    @endforeach
    @endif
   });
 </script>
@endsection