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
            <strong>Admin Registration</strong>
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
                        <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="name" value="{{ old('name', $admin->name) }}">
                    </div>
                        @error('name')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Email </span>
                        </div>
                        <input type="email" class="form-control"  aria-describedby="basic-addon1" required="required" name="email" value="{{ old('email', $admin->email) }}">
                    </div>
                       @error('email')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  </div>
                  <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Address</span>
                        </div>
                        <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="address" value="{{old('address', $admin->address)}}">
                    </div>
                       @error('address')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    <div class="input-group  input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Ph No.</span>
                        </div>
                        <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="ph_no" value="{{old('ph_no', $admin->ph_no)}}">
                    </div>
                       @error('ph_no')
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
  				<strong>Admins List</strong>
  				<input type="text" name="search" class="float-right" placeholder="search here">
          <a href="{{route('admin.trash')}}" class="ml-2">Go to Trash List</a>
  			</div>
  			<div class="card-body">
  				<table class="table">
  					<thead class="thead-dark">
  						<tr>
  							<th>#</th>
  							<th>Name</th>
  							<th>Email</th>
  							<th>Ph No.</th>
  							<th colspan="3">Action</th>
  						</tr>
  					</thead>
  					<tbody>
  						@if(isset($admins) && count($admins)>0)
              @foreach($admins as $admin)
  						<tr>
  							<td>{{$i++}}</td>
  							<td>{{$admin->name}}</td>
  							<td>{{$admin->email}}</td>
  							<td>{{$admin->ph_no}}</td>
  							<td><a href="{{route('admin.show', $admin)}}"><i class="fas fa-edit"></i></a></td>
  							<td><a href="#" id="destroy{{$admin->id}}"><i class="fas fa-trash"></i></a>
                  <form hidden="hidden" method="post" action="{{route('admin.destroy', $admin)}}" id="delete{{$admin->id}}">@csrf{{ method_field('DELETE') }}</form>
                </td>
  							<td><a href="#"><i class="fas fa-eye"></i></a></td>
  						</tr>
              @endforeach
  						@endif
              @if(isset($admins) && count($admins)<=0)
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
           <div class="row">
           {{ $admins->links() }}
         </div>
  			</div>
  		</div>
  	</div>
  </div>
</div>
@endsection
@section('scripts')
   <script type="text/javascript">
     $(document).ready(function(){
      @if(isset($admins) && count($admins)>0)
      @foreach($admins as $admin)
        $('#destroy{{$admin->id}}').on('click', function(event){
            event.preventDefault();
            $('#delete{{$admin->id}}').submit();
        });
      @endforeach
      @endif
     });
   </script>
@endsection