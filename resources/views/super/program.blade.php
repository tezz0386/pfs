@extends('layouts.super-app')
@section('content')
<div class="row">
  <div class="col-md-12">
    @include('partial.success')
    @include('partial.error')
  </div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <center><strong>Program Registration</strong></center>
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
          <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="program_name" value="{{ old('program_name', $program->program_name) }}">
        </div>
        @error('program_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="row">
          <div class="col-md-6">
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Small Form</span>
              </div>
              <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="sm_form" value="{{ old('sm_form', $program->sm_form) }}" placeholder="eg:-BCA">
            </div>
            @error('sm_form')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Code</span>
              </div>
              <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="program_code" value="{{ old('program_code', $program->program_code) }}">
            </div>
            @error('program_code')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror</div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Description</span>
          </div>
          <textarea class="form-control"  aria-describedby="basic-addon1" name="program_description" rows="6">{{ old('program_description', $program->program_description) }}</textarea>
        </div>
        @error('program_description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary float-right btn-sm">{{$btn_text}}</button>
      </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <strong>Programs </strong>
      <input type="text" name="search" id="search" class="float-right" placeholder="search here">
    </div>
    <div class="card-body">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Small Form</th>
            <th>Program Code</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($programs) && count($programs)>0)
          @foreach($programs as $program)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$program->program_name}}</td>
            <td>{{$program->sm_form}}</td>
            <td>{{$program->program_code}}</td>
            <td><a href="{{route('program.show', $program)}}"><i class="fas fa-edit"></i></a></td>
            <td><a href="#"><i class="fas fa-trash"></i></a></td>
            <td><a href="#"><i class="fas fa-eye"></i></a></td>
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
@endsection