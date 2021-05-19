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
      <center><strong>Subject Registration</strong></center>
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
          <input type="text" class="form-control"  aria-describedby="basic-addon1" required="required" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}">
        </div>
        @error('subject_name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Description</span>
          </div>
          <textarea class="form-control"  aria-describedby="basic-addon1" name="subject_description" rows="6">{{ old('subject_description', $subject->subject_description) }}</textarea>
        </div>
        @error('subject_description')
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
      <strong>Subjects </strong>
      <input type="text" name="search" id="search" class="float-right" placeholder="search here">
    </div>
    <div class="card-body">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($subjects) && count($subjects)>0)
          @foreach($subjects as $subject)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$subject->subject_name}}</td>
            <td><a href="{{route('subject.show', $subject)}}"><i class="fas fa-edit"></i></a></td>
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
      {{$subjects->links()}}
    </div>
  </div>
</div>
@endsection