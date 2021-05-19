@extends('layouts.app')
@section('content')
  <div class="container margin">
  	<div class="row">
  		<div class="col-md-4 list-div">
  			<h4>Tribhuwan University</h4>
        <!-- Icon goes here -->
        <strong>Program : BBS, Year Ways</strong>
  			<ul class="list-unstyled">
  				@for($i=1; $i<9; $i++)
             <li><i class="fas fa-check-square"></i><a  data-toggle="collapse" href="#collapseExample{{$i}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$i}}" style="color: black; font-size: 20px;">{{$i}}st Yesr</a>
                 <ul class="list-unstyled collapse ml-3" id="collapseExample{{$i}}">
                     <li>
                           <a href="#">Statistics </a>
                     </li>
                      <li>
                           <a href="#">Program 2</a>
                     </li>
                      <li>
                           <a href="#">Program 3</a>
                     </li>
                  </ul>
             </li>
          @endfor
  			</ul>
  		</div>
  		<div class="col-md-8">
  			<div class="row">
  				<div class="col-md-12">
  						<div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                  <input placeholder="search here" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
              </div>
  				</div>
  			  <div class="card card-body">
  				<center>1st Year, Economocis</center>
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
  				<center> 1st year Computer Science</center>
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
  				<center>1st year, Business Sutdies</center>
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
          <center> 1st year Computer Science</center>
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
          <center> 1st year Computer Science</center>
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
          <center> 1st year Computer Science</center>
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
          <center> 1st year Computer Science</center>
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