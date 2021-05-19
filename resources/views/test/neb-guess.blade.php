@extends('layouts.app')
@section('content')
  <div class="container margin">
  	<div class="row">
  		<div class="col-md-4 list-div">
  			<h4>XI :- Management</h4>
  			<ul class="list-unstyled">
  				<li><i class="fas fa-check-square"></i><a href="#">Economics</a></li>
  				<li><i class="fas fa-check-square"></i><a href="#">Business Studies</a></li>
  				<li><i class="fas fa-check-square"></i><a href="#">Computer Science</a></li>
  			</ul>
  		</div>
  		<div class="col-md-8">
  			<div class="row">
  				<div class="col-md-12">
  						<button type="button" class="btn float-right"><i class="fas fa-sort"></i></button>
  				</div>
  			  <div class="card card-body">
  				<center>Economics</center>
  				<table class="table">
  					<thead class="thead-dark">
  						<tr>
  						   <th>#</th>
  						   <th>Edition</th>
  						   <th>Year</th>
  						   <th colspan="2">Action</th>
  					    </tr>
  					</thead>
  					<tbody>
  						@for($i=1; $i<5; $i++)
  						<tr>
  							<td>{{$i}}</td>
  							<td>1st</td>
  							<td>2077</td>
  							<td><a href="#"><i class="fab fa-readme"></i></a></td>
  							<td><a href="#"><i class="fas fa-download"></i></a></td>
  						</tr>
  						@endfor
  					</tbody>
  				</table>
  			   </div>
  			</div>
  			<div class="row">
  			  <div class="card card-body">
  				<center>Computer Science</center>
  				<table class="table">
  					<thead class="thead-dark">
  						<tr>
  						   <th>#</th>
  						   <th>Edition</th>
  						   <th>Year</th>
  						   <th colspan="2">Action</th>
  					    </tr>
  					</thead>
  					<tbody>
  						@for($i=1; $i<5; $i++)
  						<tr>
  							<td>{{$i}}</td>
  							<td>1st</td>
  							<td>2077</td>
  							<td><a href="#"><i class="fab fa-readme"></i></a></td>
  							<td><a href="#"><i class="fas fa-download"></i></a></td>
  						</tr>
  						@endfor
  					</tbody>
  				</table>
  			   </div>
  			</div>
  			<div class="row">
  			  <div class="card card-body">
  				<center>Business Sutdies</center>
  				<table class="table">
  					<thead class="thead-dark">
  						<tr>
  						   <th>#</th>
  						   <th>Edition</th>
  						   <th>Year</th>
  						   <th colspan="2">Action</th>
  					    </tr>
  					</thead>
  					<tbody>
  						@for($i=1; $i<5; $i++)
  						<tr>
  							<td>{{$i}}</td>
  							<td>1st</td>
  							<td>2077</td>
  							<td><a href="#"><i class="fab fa-readme"></i></a></td>
  							<td><a href="#"><i class="fas fa-download"></i></a></td>
  						</tr>
  						@endfor
  					</tbody>
  				</table>
  			   </div>
  			</div>
  		</div>
  	</div>
  </div>
@endsection