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
          <center><strong>Faculty Registration</strong></center>
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
              <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="faculty_name" value="{{ old('faculty_name', $faculty->faculty_name) }}">
            </div>
            @error('faculty_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Code</span>
              </div>
              <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="faculty_code" value="{{ old('faculty_code', $faculty->faculty_code) }}">
            </div>
            @error('faculty_code')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Description</span>
              </div>
              <textarea class="form-control"  aria-describedby="basic-addon1" name="faculty_description" rows="6">{{ old('faculty_description', $faculty->faculty_description) }}</textarea>
            </div>
            @error('facluty_description')
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
          <strong>Faculties</strong>
          <input type="text" name="search" id="search" class="float-right" placeholder="search here">
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Faculty Code</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($faculties) && count($faculties)>0)
              @foreach($faculties as $faculty)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$faculty->faculty_name}}</td>
                <td>{{$faculty->faculty_code}}</td>
                <td><a href="{{route('faculty.show', $faculty)}}"><i class="fas fa-edit"></i></a></td>
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