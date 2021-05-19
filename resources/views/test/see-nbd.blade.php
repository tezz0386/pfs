@extends('layouts.app')
@section('content')
 <div class="container margin">
 	<div class="row">
 		<div class="col-md-8">
 		  <div class="card">
 			<div class="card-header">
 			   <center><h4>SEE :- Sub 1</h4></center>
 			</div>
 			<div class="card-body">
 				     <div class="row">
 				     	<div class="col-md-6">
 				     		<div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort"></i></span>
                                 </div>
                                <select class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                	<option>Sort By</option>
                                 	<option>By Date</option>
                                 	<option>By Publiction</option>
                                 	<option>By Edition</option>
                                </select>
                            </div>
 				     	</div>
 				     	<div class="col-md-6">
 				     		<div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                 </div>
                                <input placeholder="search here" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
 				     	</div>
 				     </div>
 				<table class="table">
 					<thead class="thead-dark">
 						<tr>
 							<th>#</th>
 							<th>Edition</th>
 							<th>year</th>
 							<th>Publication</th>
 							<th colspan="2">Action</th>
 						</tr>
 					</thead>
 					<tbody>
                        @for($i=1; $i<5; $i++)
 						<tr>
 							<td>{{$i}}</td>
 						      <td>{{$i}}st</td>
 						      <td>2077</td>
 						      <td>Asmita Publication</td>
 						      <td><a href="#"><i class="fab fa-readme"></i></a></td>
 						      <td><a href="#"><i class="far fa-download"></i></a></td>
 						</tr>
                        @endfor
 					</tbody>
 				</table>
 			</div>
 		  </div>
 		</div>
 		<div class="col-md-4">
 			
 		</div>
 	</div>
 </div>
@endsection