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
          <center>
            <strong>University Registration</strong>
          </center>
        </div>
        <div class="card-body">
          <form action="{{$action}}" method="{{$method}}">
            @csrf
            @if($check)
            {{ method_field('PATCH') }}
            @endif
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Name</span>
                        </div>
                        <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="university_name" value="{{ old('university_name', $university->university_name) }}">
                    </div>
                        @error('university_name')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Small Form </span>
                        </div>
                        <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="sm_form" value="{{ old('sm_form', $university->sm_form) }}">
                    </div>
                       @error('sm_form')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  </div>
                  <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">University Code</span>
                        </div>
                        <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="university_code" value="{{old('university_code', $university->university_code)}}">
                    </div>
                       @error('university_code')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <button type="submit" class="btn btn-primary btn-sm float-right">{{$btn_text}}</button>
                  </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  	<div class="col-md-12">
  		<div class="card">
  			<div class="card-header">
  				<strong>Universities List</strong>
  				<input type="text" name="search" class="float-right" placeholder="search here">
          <a href="{{route('university.trash')}}" class="ml-2">Go to Trash List</a>
  			</div>
  			<div class="card-body">
  				<table class="table">
  					<thead class="thead-dark">
  						<tr>
  							<th>#</th>
  							<th>Name</th>
  							<th>Small Form</th>
  							<th>University Code</th>
  							<th colspan="2">Action</th>
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
  							<td><a href="{{route('university.show', $university)}}"><i class="fas fa-edit"></i></a></td>
  							<td><a href="#" id="destroy{{$university->id}}"><i class="fas fa-trash"></i></a>
                  <form hidden="hidden" method="post" action="{{route('university.destroy', $university)}}" id="delete{{$university->id}}">@csrf{{ method_field('DELETE') }}</form>
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
        $('#destroy{{$university->id}}').on('click', function(event){
            event.preventDefault();
            $('#delete{{$university->id}}').submit();
        });
      @endforeach
      @endif
     });
   </script>
@endsection