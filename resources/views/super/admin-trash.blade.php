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
  				<strong>Trashed Admins List</strong>
  				<input type="text" name="search" class="float-right" placeholder="search here">
          <a href="{{route('admin.index')}}" class="ml-2">Go to active Admins List</a>
  			</div>
  			<div class="card-body">
  				<table class="table">
  					<thead class="thead-dark">
  						<tr>
  							<th>#</th>
  							<th>Name</th>
  							<th>Email</th>
  							<th>Ph No.</th>
  							<th colspan="4">Action</th>
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
  							<td><a href="{{route('admin.edit', $admin)}}"><i class="fas fa-edit"></i></a></td>
  							<td><a href="#" id="restore{{$admin->id}}"><i class="fas fa-trash-restore"></i></a>
                  <form hidden="hidden" method="post" action="{{route('admin.restore', $admin)}}" id="restored{{$admin->id}}">@csrf{{ method_field('POST') }}</form>
                </td>
  							<td><a href="#"><i class="fas fa-eye"></i></a></td>
                <td><a href="#" id="permanent{{$admin->id}}">Delete</a>
                   <form hidden="hidden" method="post" action="{{route('admin.delete', $admin)}}" id="permanent-delete{{$admin->id}}">@csrf{{ method_field('DELETE') }}</form>
                </td>
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
          {{ $admins->links() }}
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
        $('#restore{{$admin->id}}').on('click', function(event){
            event.preventDefault();
            $('#restored{{$admin->id}}').submit();
        });
         $('#permanent{{$admin->id}}').on('click', function(event){
            event.preventDefault();
            $('#permanent-delete{{$admin->id}}').submit();
        });
      @endforeach
      @endif
     });
   </script>
@endsection