@extends('layouts.super-app')
@section('content')
<div class="row">
  <div class="col-md-12">
    @include('partial.success')
    @include('partial.error')
  </div>
</div>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <center><strong>Levels Registration</strong></center>
        </div>
        <div class="card-body">
          <form action="{{$action}}" method="{{$method}}">
            @csrf
            @if($check)
            {{method_field('PATCH')}}
            @endif
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Name</span>
              </div>
              <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="level_name" value="{{ old('level_name', $level->level_name) }}">
            </div>
            @error('level_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Code</span>
              </div>
              <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="level_code" value="{{ old('level_code', $level->level_code) }}">
            </div>
            @error('level_code')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary float-right btn-sm">{{$btn_text}}</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <strong>Levels</strong>
          <input type="text" name="search" id="search" class="float-right" placeholder="search here">
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Level Code</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($levels) && count($levels)>0)
              @foreach($levels as $level)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$level->level_name}}</td>
                <td>{{$level->level_code}}</td>
                <td><a href="{{route('level.show', $level)}}"><i class="fas fa-edit"></i></a></td>
                <td><a href="{{route('level.getProgram', $level)}}"><i class="fas fa-eye"></i></a></td>
                <td><a href="#"><i class="fas fa-trash"></i></a></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4">
                  <center>No Record Found</center>
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection