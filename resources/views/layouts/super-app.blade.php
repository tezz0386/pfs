<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if(isset($title)) {{$title}} @else PFS @endif</title>
        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="{{asset('asset/super-app.css')}}">
        <script type="text/javascript" src="{{asset('asset/super-app.js')}}"></script>
    </head>
    <body>
       		<div class="content">
				<nav class="navbar navbar-expand-sm bg-dark">
					<label style="position: absolute; left: 0; top: 6px;" id="toggle"><span style="font-size:30px;cursor:pointer; color: white;" onclick="closeNav()">&#9776;</span></label>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="#">	<i class="fa fa-comments custom"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-bell custom"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-envelope custom"></i></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
								<i class="fa fa-user-circle custom"></i>
							</a>
							<div class="dropdown-menu" style="left: -12px;background-color: grey;top: 44px;">
								<a class="dropdown-item" href="#">Profile</a>
								<a class="dropdown-item" href="#" id="logout">Logout</a>
								<form hidden="hidden" method="post" action="{{route('super.logout')}}" id="logout_form">
									@csrf
								</form>
							</div>
						</li>
					</ul>
				</nav>
				
				<div class="ml-1 mt-1 mr-1">
					@yield('content')
				</div>	
			</div>
			<div id="mySidenav" class="sidenav">
				<a href="{{route('super')}}" style="color: black; font-size: 26px;" class="mt-4 ml-2">Logo</a>
				<hr class="my-hr">
				<a href="{{route('super')}}" class="mt-3 ml-2 @if(isset($d_check)) active @endif"><i class="fas fa-tachometer-alt-fast mr-2"></i> Dashboard</a>
				<hr class="my-hr">
				<div class="ml-3 mt-3">
					<!-- Example single danger button -->
				    <a href="{{route('admin.index')}}" @if(isset($active))class="active"@endif>Admin</a>
					<h5><u>Content</u></h5>
					<a href="{{route('university.index')}}" @if(isset($u_check)) class="active"@endif>University</a>
					<a href="{{route('faculty.index')}}" @if(isset($f_check)) class="active"@endif>Faculty</a>
					<a href="{{route('level.index')}}" @if(isset($l_check)) class="active" @endif>Level</a>
					<a href="{{route('program.index')}}" @if(isset($p_check)) class="active" @endif>Program</a>
					<a href="{{route('subject.index')}}" @if(isset($s_check)) class="active @endif">Subjects</a>
					<a href="{{route('crash.index')}}" @if(isset($c_check)) class="active" @endif>Crash</a>
					<a href="#">Others</a>
				</div>
			</div>
			@yield('scripts')
			<script type="text/javascript">
				$(document).ready(function(){
					$('#logout').on('click', function(event){
						event.preventDefault();
						$('#logout_form').submit();
				    });
				});
			</script>
    </body>
</html>