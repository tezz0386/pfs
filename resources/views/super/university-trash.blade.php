@extends('layouts.super-app')
@section('content')
<div class="col-md-12">
  @include('partial.success')
  @include('partial.error')
</div>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong>Universities List</strong>
          <input type="text" name="search" class="float-right" placeholder="search here">
          <a href="{{route('university.index')}}" class="ml-2">Go to Active Universities List</a>
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Small Form</th>
                <th>University Code</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($universities) && count($universities)>0)
              @foreach($universities as $university)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$university->university_name}}</td>
                <td>{{$university->sm_form}}</td>
                <td>{{$university->university_code}}</td>
                <td><a href="#" id="restore{{$university->id}}"><i class="fas fa-trash-restore"></i></a>
                  <form hidden="hidden" method="post" action="{{route('university.restore', $university)}}" id="restored{{$university->id}}">@csrf</form>
                </td>
                <td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#" id="delete{{$university->id}}">delete</a>
                   <form hidden="hidden" method="post" action="{{route('university.delete', $university)}}" id="deletePermanent{{$university->id}}">@csrf{{ method_field('DELETE') }}</form>
                </td>
              </tr>
              @endforeach
              @endif
              @if(isset($universities) && count($universities)<=0)
              <tr>
                <td colspan="7">
                  <center>
                    <strong>No Record Founds</strong>
                  </center>
                </td>
              </tr>
              @endif
            </tbody>
          </table>
          {{ $universities->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
   <script type="text/javascript">
     $(document).ready(function(){
      @if(isset($universities) && count($universities)>0)
      @foreach($universities as $university)
        $('#restore{{$university->id}}').on('click', function(event){
            event.preventDefault();
            $('#restored{{$university->id}}').submit();
        });
         $('#delete{{$university->id}}').on('click', function(event){
            event.preventDefault();
            $('#deletePermanent{{$university->id}}').submit();
        });
      @endforeach
      @endif
     });
   </script>
@endsection