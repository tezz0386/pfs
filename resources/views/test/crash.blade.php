@extends('layouts.app')
@section('content')
  <div class="container margin">
  	<div class="row">
  		<div class="col-md-3 list-div">
  			<center>
  				<img src="{{asset('asset/image1/html.PNG')}}" height="70" width="70" class="mb-3">
  			</center>
  			<ul class="list-unstyled">
  				<li>
  					<a href="#">Introduction</a>
  				</li>
  				<li>
  					<a href="#">Installation / Setup</a>
  				</li>
  				<li>
  					<a href="#">Structure</a>
  				</li>
  			</ul>
  		</div>
  		<div class="col-md-6">
  			<h5><u>Introduction</u></h5>
  			<p>
  				HTML is the standard markup language for Web pages.

                With HTML you can create your own Website.

                HTML is easy to learn - You will enjoy it!
  			</p>
  			<button type="button" class="btn btn-info">Start Learning Now</button>
  			<h5 class="mt-3"><u>HTML References</u></h5>
  			<p>
  				
  			</p>

  		</div>
  		<div class="col-md-3">
  			<h5><u>Learn From Video</u></h5>
  			<iframe width="200" height="200" src="https://www.youtube.com/embed/17hiro8LVjE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  		</div>
  	</div>
  </div>
@endsection