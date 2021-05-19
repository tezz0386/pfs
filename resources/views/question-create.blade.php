@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-4 col-lg-4 col-sm-12 col-xl-4 col-4 d-none d-sm-block d-sm-none d-md-block" style="border-right: 1px solid black">
      <div class="card">
        <div class="card-header"><center><strong>Recently Aksed Questions</strong></center></div>
        <div class="card-body">
          @if(isset($questions) && count($questions)>0)
          <ul class="list-unstyled">
            @foreach($questions as $question)
            <li class="mb-2">
              <a href="#">{{$question->title}}</a>
            </li>
            @endforeach
          </ul>
           @else
           <center><strong>Questions not available now</strong></center>
           @endif
        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-primary float-right">Review Your Questions</button>
        </div>
      </div>
  </div>
  <div class="col-md-8 col-lg-8 col-sm-12 col-xl-8 col-12">
    <p class="alert alert-info">
       @if(Session::has('success'))
         {{Session::get('success')}}
       @endif
    </p>
    <form action="{{route('user.ask.post')}}" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <center><strong>Your Question Subbmission Form</strong></center>
        </div>
        <div class="card-body">
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Choose Category</span>
            </div>
            <select class="form-control" name="question_category" id="question_category">
              <option value="GK">General Knowledge</option>
              <option value="TK">Technical knowledge</option>
              <option value="STK">Science & Technology</option>
              <option value="others">Others</option>
            </select>
          </div>
          <label>Just think what do you want to ask to another person</label>
            <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Title</span>
            </div>
            <input type="text" name="title" class="form-control" placeholder="eg: Is the HTML is programming language or not?">
          </div>
          <br>
          <center>Provide all information through which any user can answer you</center>
          <label>Body</label>
          <textarea class="form-control" name="question" id="editor1" name="question"></textarea>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary float-right">Ask Now</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('scripts')
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