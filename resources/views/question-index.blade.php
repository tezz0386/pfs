@extends('layouts.app')
@section('content')
<?php 
  use App\Models\User;
 ?>
<div class="row">
  <div class="col-md-4 col-lg-4 col-sm-12 col-xl-4 col-4 d-none d-sm-block d-sm-none d-md-block" style="border-right: 1px solid black">
    <div class="card">
      <div class="card-header"><center><strong>Recently Aksed Questions</strong></center></div>
      <div class="card-body">
        @if(isset($questions) && count($questions)>0)
        <ul class="list-unstyled">
          @foreach($questions as $question)
          <hr>
          <li class="mb-2">
            <a href="#">{{$question->title}}</a>
          </li>
          @if(count($question->answers)>0)
          <label>{{count($question->answers)}} Answers</label>
          @else
          <label>0 Answer At</label>
          @endif
          <button class="btn btn-primary btn-sm float-right">Answer Now</button>
          @endforeach
        </ul>
        @else
        <center><strong>Questions not available now</strong></center>
        @endif
      </div>
      <div class="card-footer">
        @if(Auth::check())
        <button class="btn btn-sm btn-primary float-right">Review Your Questions</button>
        @endif
      </div>
    </div>
  </div>
  <div class="col-md-8 col-lg-8 col-sm-12 col-xl-8 col-12">
    @if(isset($questions) && count($questions)>0)
    <ul class="list-unstyled">
      @foreach($questions as $question)
      <hr>
      <li>
        <div class="card">
          <div class="card-header" style="background-color: #d4c2c2;">
            <strong>{{$question->title}}</strong>
            @if(count($question->answers)>0)
            <label>{{count($question->answers)}} Answers</label>
            @else
            <label>0 Answer At</label>
            @endif
          </div>
          <div class="card-body">
            @if($question->question != '')
            <strong>Some infromation about this question</strong>
            @endif
            {!! $question->question !!}
            @if(count($question->answers)>0)
               <u><strong>Answers</strong></u>
               <ol>
                  @foreach($question->answers as $answer)
                    <li style="font-size: 18px; font-family: bold;">Answer</li>
                       {!! $answer->answer !!} 

                       <label>Posted By: <a href="#">{{ User::select('name')->where('id', $answer->uid)->first()->name}}</a> At {{$answer->created_at}}</label>
                    <br>
                  @endforeach
               </ol>
            @endif
          </div>
          <div class="card-footer" style="background-color: #d4c2c2;">
            <div class="row">
              <div class="col-md-3 col-lg-3 col-3 col-sm-3 col-xl-3">
                <a href="#" style="font-size: 18px;"><i class="fal fa-thumbs-up"></i></a>
              </div>
              <div class="col-md-6 col-lg-6 col-6 col-sm-6 col-xl-6">
                <center>
                  <a class="btn btn-primary btn-sm" href="#"  data-toggle="modal" data-target="#exampleModalLong" id="lunchModal{{$question->id}}" questionTitle="{{$question->title}}" question_id="{{$question->id}}">Answer Now</a>
                </center>
              </div>
              <div class="col-md-3 col-lg-3 col-3 col-sm-3 col-xl-3">
                <a href="#" style="font-size: 18px" class="float-right"><i class="fas fa-share"></i></a>
              </div>
            </div>
          </div>
        </div>
        <br>
      </li>
      <hr>
      @endforeach
    </ul>
    @else
    <center><strong>Questions not available please try again</strong></center>
    @endif
  </div>
  {{$questions->links()}}
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><u id="modalTitle"></u></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.answer.store')}}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="question_id" id="question_id">
          <textarea class="editor1" id="editor1" name="answer"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Post Answer</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      @if(isset($questions) && count($questions)>0)
          @foreach($questions as $question)
            $('#lunchModal{{$question->id}}').on('click', function(e){
              e.preventDefault();
              $('#question_id').val($(this).attr('question_id'));
              $('#modalTitle').text($(this).attr('questionTitle'));
            });
          @endforeach
      @endif
    });
  </script>

<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('ckeditor/ckfinder/ckfinder/ckfinder.js')}}"></script>
<script type="text/javascript">
  // CKEDITOR.replace( 'editor1' );
   CKEDITOR.on('dialogDefinition', function (ev) {
    var dialogName = ev.data.name,
        dialogDefinition = ev.data.definition;

    if (dialogName == 'image') {
        var onOk = dialogDefinition.onOk;

        dialogDefinition.onOk = function (e) {
            var width = this.getContentElement('info', 'txtWidth');
            width.setValue('300');//Set Default Width

            var height = this.getContentElement('info', 'txtHeight');
            height.setValue('250');////Set Default height

            onOk && onOk.apply(this, e);
        };
    }
});

  var editor = CKEDITOR.replace( 'editor1',{
    filebrowserBrowseUrl: '',
  } );
  CKFinder.setupCKEditor( editor );
</script>


@endsection