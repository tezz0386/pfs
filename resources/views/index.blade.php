@extends('layouts.app')
@section('content')
<?php 

use App\Help\NepaliDate;
use Illuminate\Support\Facades\Storage;
  $nepali_date= new NepaliDate();
 ?>
<div class="row container1" style="margin-top: -16px;">
  <img src="{{asset('asset/image1/banner1.PNG')}}" style="width: 100%; height: 35%;">
  <div class="bottom-left-content">we are providing you the best <label style="background-color: #d819199c; border-radius: 9px;">platform for study</label> in nepal</div>
  <div class="bottom-left"><a href="#" id="left-button" class="btn">Get Start Now</a></div>
</div>
 @if(isset($error))
   <h5 class="mt-5">Sorry !!</h5>
   <label>Now we are not able to provide you the navigational content for this navigation. We will make this available as soon as possible. Thank You.....</label>
 @endif
<hr style="border-color: #0000005c;">
@if(isset($contents) && count($contents)>0)
<div class="row">
   <div class="col-md-4 col-lg-4 col-sm-12 col-12 col-xl-4">
    @if(isset($levels) && count($levels)>0)
    @foreach($levels as $level)
    @if(isset($universities) && count($universities)>0)
    @foreach($universities as $university)
      @if(isset($programs) && count($programs)>0)
      @foreach($programs as $program)
      @if($program->university_id === $university->id && $program->id === $program->program_id && $level->id === $program->level_id)
    <div id="question{{$program->assistant_id}}"></div>
    @foreach($contents as $content)
    @if($content->assistant_id === $program->assistant_id && $content->mode==1)
    <ul id="menu">
      <li>{{$content->year_name}} @if($content->ways==2) Semester @else Year @endif</li>
      <li>{{$content->subject_name}}-{{$content->year}}({{$nepali_date->get_eng_year($content->year, 1, 1)}})</li>
      <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf{{$content->id}}" file_name="{{url('/asset/bc-ms/'.$content->file_name)}}"><i class="fab fa-readme"></i></a></li>
      <li><a href="{{asset('/asset/bc-ms/'.$content->file_name)}}"><i class="fas fa-download"></i></a></li>
    </ul>
    @endif
    @endforeach
   @endif
      @endforeach
      @endif
    @endforeach
    @endif
    @endforeach
    @endif
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-12 col-xl-4">
    @if(isset($levels) && count($levels)>0)
    @foreach($levels as $level)
    @if(isset($universities) && count($universities)>0)
    @foreach($universities as $university)
      @if(isset($programs) && count($programs)>0)
      @foreach($programs as $program)
      @if($program->university_id === $university->id && $program->id === $program->program_id && $level->id === $program->level_id)
    <div id="notes{{$program->assistant_id}}"></div>
    @foreach($contents as $content)
    @if($content->assistant_id === $program->assistant_id && $content->mode==2)
    <ul id="menu">
      <li>{{$content->year_name}} @if($content->ways==2) Semester @else Year @endif</li>
      <li>{{$content->subject_name}}-{{$content->year}}({{$nepali_date->get_eng_year($content->year, 1, 1)}})</li>
      <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf{{$content->id}}" file_name="{{url('/asset/bc-ms/'.$content->file_name)}}"><i class="fab fa-readme"></i></a></li>
      <li><a href="{{asset('/asset/bc-ms/'.$content->file_name)}}"><i class="fas fa-download"></i></a></li>
    </ul>
    @endif
    @endforeach
   @endif
      @endforeach
      @endif
    @endforeach
    @endif
    @endforeach
    @endif
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-12 col-xl-4">
    @if(isset($levels) && count($levels)>0)
    @foreach($levels as $level)
    @if(isset($universities) && count($universities)>0)
    @foreach($universities as $university)
      @if(isset($programs) && count($programs)>0)
      @foreach($programs as $program)
      @if($program->university_id === $university->id && $program->id === $program->program_id && $level->id === $program->level_id)
    <div id="guess{{$program->assistant_id}}"></div>
    @foreach($contents as $content)
    @if($content->assistant_id === $program->assistant_id && $content->mode==3)
    <ul id="menu">
      <li>{{$content->year_name}} @if($content->ways==2) Semester @else Year @endif</li>
      <li>{{$content->subject_name}}-{{$content->year}}({{$nepali_date->get_eng_year($content->year, 1, 1)}})</li>
      <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf{{$content->id}}" file_name="{{url('/asset/bc-ms/'.$content->file_name)}}"><i class="fab fa-readme"></i></a></li>
      <li><a href="{{asset('/asset/bc-ms/'.$content->file_name)}}"><i class="fas fa-download"></i></a></li>
    </ul>
    @endif
    @endforeach
   @endif
      @endforeach
      @endif
    @endforeach
    @endif
    @endforeach
    @endif
    </div>
    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
      <center><a href="#">< Show All ></a></center>
    </div>
</div>
<hr style="border-color: #0000005c;">
@endif
<div class="row">
  <!-- this is for ads -->
</div>
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
          @if($content3->mode==1 && $content3->class == 1 && $content3->faculty_id == $faculty->id)
            <ul id="menu">
              <li>{{$content3->subject_name}}-{{$content3->year}}({{$nepali_date->get_eng_year($content3->year, 1, 1)}})</li>
              <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf-content3{{$content3->id}}" file_name="{{url('/asset/see-neb/'.$content3->file_name)}}"><i class="fab fa-readme"></i></a></li>
              <li><a href="{{asset('/asset/see-neb/'.$content3->file_name)}}"><i class="fas fa-download"></i></a></li>
            </ul>
          @endif
      @endforeach
      @endforeach
      @endif
      </div>

      <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
      @if(isset($faculties) && count($faculties)>0)
      @foreach($faculties as $faculty)
        <h6 id="xi-guess-faculty{{$faculty->id}}"><u></u></h6>
      @foreach($contents3 as $content3)
          @if($content3->mode==2 && $content3->class == 1 && $content3->faculty_id == $faculty->id)
            <ul id="menu">
              <li>{{$content3->subject_name}}-{{$content3->year}}({{$nepali_date->get_eng_year($content3->year, 1, 1)}})</li>
              <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf-content3{{$content3->id}}" file_name="{{url('/asset/see-neb/'.$content3->file_name)}}"><i class="fab fa-readme"></i></a></li>
              <li><a href="{{asset('/asset/see-neb/'.$content3->file_name)}}"><i class="fas fa-download"></i></a></li>
            </ul>
          @endif
      @endforeach
      @endforeach
      @endif
      </div>
    </div>
     <div class="row">
      <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
      @if(isset($faculties) && count($faculties)>0)
      @foreach($faculties as $faculty)
        <h6 id="xii-old-faculty{{$faculty->id}}"><u></u></h6>
      @foreach($contents3 as $content3)
          @if($content3->mode==1 && $content3->class == 2 && $content3->faculty_id == $faculty->id)
            <ul id="menu">
              <li>{{$content3->subject_name}}-{{$content3->year}}({{$nepali_date->get_eng_year($content3->year, 1, 1)}})</li>
              <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf-content3{{$content3->id}}" file_name="{{url('/asset/see-neb/'.$content3->file_name)}}"><i class="fab fa-readme"></i></a></li>
              <li><a href="{{asset('/asset/see-neb/'.$content3->file_name)}}"><i class="fas fa-download"></i></a></li>
            </ul>
          @endif
      @endforeach
      @endforeach
      @endif
      </div>

      <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
      @if(isset($faculties) && count($faculties)>0)
      @foreach($faculties as $faculty)
        <h6 id="xii-guess-faculty{{$faculty->id}}"><u></u></h6>
      @foreach($contents3 as $content3)
          @if($content3->mode==2 && $content3->class == 2 && $content3->faculty_id == $faculty->id)
            <ul id="menu">
              <li>{{$content3->subject_name}}-{{$content3->year}}({{$nepali_date->get_eng_year($content3->year, 1, 1)}})</li>
              <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf-content3{{$content3->id}}" file_name="{{url('/asset/see-neb/'.$content3->file_name)}}"><i class="fab fa-readme"></i></a></li>
              <li><a href="{{asset('/asset/see-neb/'.$content3->file_name)}}"><i class="fas fa-download"></i></a></li>
            </ul>
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
<div class="row">
  <!-- this is for ads -->
</div>
@if(isset($contents2) && count($contents2)>0)
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
    <h6><u><a href="#">SEE</u></a></a></h6>
    <div class="row">
      <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
        <h6><u>Old Question</u></h6>
      @foreach($contents2 as $content2)
          @if($content2->mode==1)
            <ul id="menu">
              <li>{{$content2->subject_name}}-{{$content2->year}}({{$nepali_date->get_eng_year($content2->year, 1, 1)}})</li>
              <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf-content2{{$content2->id}}" file_name="{{url('/asset/see-neb/'.$content2->file_name)}}"><i class="fab fa-readme"></i></a></li>
              <li><a href="{{asset('/asset/see-neb/'.$content2->file_name)}}"><i class="fas fa-download"></i></a></li>
            </ul>
          @endif
      @endforeach
      </div>
       <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-12">
        <h6><u>NBD</u></h6>
      @foreach($contents2 as $content2)
          @if($content2->mode==2)
            <ul id="menu">
              <li>{{$content2->subject_name}}-{{$content2->year}}({{$nepali_date->get_eng_year($content2->year, 1, 1)}})</li>
              <li><a id="modalActivate" data-toggle="modal" data-target="#exampleModalPreview" class="btn-link pdf-content2{{$content2->id}}" file_name="{{url('/asset/see-neb/'.$content2->file_name)}}"><i class="fab fa-readme"></i></a></li>
              <li><a href="{{asset('/asset/see-neb/'.$content2->file_name)}}"><i class="fas fa-download"></i></a></li>
            </ul>
          @endif
      @endforeach
      </div>
    </div>
  </div>
  <div class="col-md-12 col-lg-12 col-12 col-sm-12">
    <center><a href="#">< Show All ></a></center>
  </div>
</div>
<hr style="border-color: #0000005c;">
@endif
<div class="row">
  <!-- this is for ads -->
</div>


<!-- modal start for pdf viewee -->
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
<!-- modal end -->
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    @if(isset($levels) && count($levels)>0)
    @foreach($levels as $level)
    @if(isset($universities) && count($universities)>0)
    @foreach($universities as $university)
    @if(isset($programs) && count($programs)>0)
    @foreach($programs as $program)
    @if($program->university_id === $university->id && $program->id === $program->program_id && $level->id === $program->level_id)
    @if(isset($contents) && count($contents)>0)
        @foreach($contents as $content)
          $('.pdf{{$content->id}}').on('click', function(event)
          {
            event.preventDefault();
            var file_name=$(this).attr('file_name');
            // console.log(file_name);
            $('#pdf-reader').attr('src', file_name);
          });

        @if($content->assistant_id === $program->assistant_id && $content->mode==1)
        $('#question{{$program->assistant_id}}').html('<a href="#"><h6><u>{{$program->sm_form}} ({{$university->university_name}}) Question Paper </u></h6></a>');
        @elseif($content->assistant_id === $program->assistant_id && $content->mode==2)
        $('#notes{{$program->assistant_id}}').html('<a href="#"><h6><u>{{$program->sm_form}} ({{$university->university_name}}) Notes </u></h6></a>');
        @elseif($content->assistant_id === $program->assistant_id && $content->mode==3)
          $('#guess{{$program->assistant_id}}').html('<a href="#"><h6><u>{{$program->sm_form}} ({{$university->university_name}}) Guess Paper </u></h6></a>');
        @endif
        @endforeach
        @endif
    @endif
    @endforeach
    @endif
    @endforeach
    @endif
    @endforeach
    @endif


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
     @elseif($content3->mode==2 && $content3->class == 1 && $content3->faculty_id == $faculty->id)
     $('#xi-guess-faculty{{$faculty->id}}').html('<a href="#"><u>XI({{$faculty->faculty_name}})Guess Paper</a></u>');
     @elseif($content3->mode==1 && $content3->class == 2 && $content3->faculty_id == $faculty->id)
     $('#xii-old-faculty{{$faculty->id}}').html('<a href="#"><u>XII({{$faculty->faculty_name}})Old Question Paper</a></u>');
     @elseif($content3->mode==2 && $content3->class == 2 && $content3->faculty_id == $faculty->id)
     $('#xii-guess-faculty{{$faculty->id}}').html('<a href="#"><u>XII({{$faculty->faculty_name}})Guess Paper</a></u>');
     @endif
    @endforeach
    @endif
    @endforeach
    @endif
    @if(isset($contents2) && count($contents2)>0)
    @foreach($contents2 as $content2)
    $('.pdf-content2{{$content2->id}}').on('click', function(event)
          {
            event.preventDefault();
            var file_name=$(this).attr('file_name');
            // console.log(file_name);
            $('#pdf-reader').attr('src', file_name);
          });
    @endforeach
    @endif
  });
</script>
@endsection