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
        <!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="{{asset('asset/app.css')}}">
        <script type="text/javascript" src="{{asset('asset/app.js')}}"></script>
    </head>
    <body>
        <div class="header">
            <h2><a href="{{route('index')}}" style="text-decoration: none; color: black;">PFS</a></h2>
            <div id="info">
                <label id="info-text">THE BEST PLATFORM FOR STUDY IN NEPAL</label>
                @guest <a href="{{route('login')}}" class="btn btn-sm" id="login" style="background-color: #3986d6">Login/Signup</a> @endguest
            </div>
        </div>
        <nav class="navbar navbar-expand-lg sticky-top" id="navbar">
             @if(isset($crash) && $crash != '')
            <a  href="javascript:void(0)" onclick="openNav()" class="nav-link" id="course-side-nav"><i class="fas fa-bars"></i></a>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <center><img src="{{asset('asset/crash/'.$crash->crash_image)}}" height="100" width="100"></center>
                <center><strong>Tutorials of {{$crash->crash_name}}</strong></center>
                @endif
                <hr style="border-color: #0000005c">
                @if(isset($courses) && count($courses)>0)
                <ul class="list-unstyled">
                    @foreach($courses as $course)
                    <li  @if(isset($checkTitle) && $checkTitle=='checkTitle'.$course->id) class="activeMode" @endif ><a href="{{route('getCrashCourse', $course->id)}}">{{$course->title}}</a></li>
                    @endforeach
                </ul> 
            </div>
            @endif
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand nav-link" href="{{route('index')}}"><i class="fas fa-home"></i></a>
                </li>
            </ul>
            <a href="#" class="navbar-toggler nav-link" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <span class="fas fa-bars"></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            See
                        </a>
                        <div class="dropdown-menu mt-2" aria-labelledby="navbarDropdown" id="dropdown-menu" style="margin-top: 0px !important;">
                            <a class="dropdown-item" href="{{route('see-neb-content', ['level'=>1, 'mode'=>1])}}">Old Question Paper</a>
                            <a class="dropdown-item" href="{{route('see-neb-content', ['level'=>1, 'mode'=>2])}}">NBD</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  NEB  </a>
                        <ul class="dropdown-menu" id="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('see-neb-content', ['level'=>2, 'mode'=>1])}}"> Old Question Paper &raquo </a>
                            @if(isset($faculties) && count($faculties)>0)
                            <ul class="submenu dropdown-menu" id="dropdown-menu">
                                @foreach($faculties as $faculty)
                                <li><a class="dropdown-item" href="{{route('see-neb-content', ['level'=>2, 'mode'=>1, 'fc'=>$faculty->id])}}">{{$faculty->faculty_name}}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li><a class="dropdown-item" href="{{route('see-neb-content', ['level'=>2, 'mode'=>2])}}"> Guess paper / Note &raquo </a>
                        @if(isset($faculties) && count($faculties)>0)
                        <ul class="submenu dropdown-menu" id="dropdown-menu">
                            @foreach($faculties as $faculty)
                            <li><a class="dropdown-item" href="{{route('see-neb-content', ['level'=>2, 'mode'=>2, 'fc'=>$faculty->id])}}">{{$faculty->faculty_name}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                </ul>
            </li>
            @if(isset($levels) && count($levels)>0)
            @foreach($levels as $level)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">  {{ $level->level_name }}  </a>
                <ul class="dropdown-menu" id="dropdown-menu">
                    @if(isset($universities) && count($universities)>0)
                    @foreach($universities as $university)
                    <li><a class="dropdown-item" href="#"> {{$university->university_name }} &raquo </a>
                    <ul class="submenu dropdown-menu" id="dropdown-menu">
                        @if(isset($programs) && count($programs)>0)
                        @foreach($programs as $program)
                        @if($program->university_id === $university->id && $program->id === $program->program_id && $level->id === $program->level_id)
                        <li><a class="dropdown-item" href=""> {{$program->sm_form }} &raquo </a>
                        <ul class="submenu dropdown-menu" id="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Question Paper</a></li>
                            <li><a class="dropdown-item" href="#">Notes / Guess Paper</a></li>
                        </ul>
                    </li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </li>
            @endforeach
            @endif
        </ul>
    </li>
    @endforeach
    @endif
    @if(isset($crashes) && count($crashes)>0)
    <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Learn More  </a>
        <div class="dropdown-menu megamenu" role="menu" id="dropdown-menu">
            <div class="row">
                @foreach($crashes as $crash)
                <div class="col-md-3">
                    <div class="col-megamenu">
                        <ul class="list-unstyled">
                            <li><a href="{{route('getCrash', $crash->id)}}">{{$crash->crash_name}}</a></li>
                        </ul>
                        </div>  <!-- col-megamenu.// -->
                        </div><!-- end col-3 -->
                        @endforeach
                        </div><!-- end row -->
                        </div> <!-- dropdown-mega-menu.// -->
                    </li>
                    @endif
                    
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.ask')}}">Ask ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-search"></i></a>
                    </li>
                    @if(Auth()->check())
                    <li class="nav-item">
                        <a href="#" class="nav-link notification">
                            <i class="fa fa-bell"></i>
                            <span class="notify" id="notify1">5</span>
                            <span class="notify2" id="notify2">5</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('asset/avtar.PNG')}}" width="25" height="25" style="border-radius: 10px">
                        </a>
                        <div class="dropdown-menu mt-2" aria-labelledby="navbarDropdown" id="dropdown-menu" style="margin-top: 0px !important; margin-left: -80px !important;">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">Setting</a>
                            <a class="dropdown-item" href="#" id="logout">Logout</a>
                            <form hidden="hidden" id="logoutForm" action="{{route('logout')}}" method="post">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
            <!--             <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="javascript:void(0)" onclick="openNav()"><i class="fas fa-arrow-left"></i></a>
                </li>
            </ul>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#" style="margin-top: 18px;">About</a>
                <a href="#">Services</a>
                <a href="#">Clients</a>
                <a href="#">Contact</a>
            </div> -->
        </nav>
        <div class="content">
            @yield('content')
        </div>
        <!-- footer start here -->
        <div class="footer" id="footer">
            <div class="container-fluied">
                <div class="container pt-3 pb-3">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                            <h4><u>Get In Touch</u></h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-phone"></i> 9805777500</li>
                                <li><i class="fas fa-envelope-square"></i> dangaura.tejendra.123@gmail.com</li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                            <h4><u>Quick Links</u></h4>
                            <ul class="list-unstyled">
                                <li><a href="#">SEE</a></li>
                                <li><a href="#">NEB</a></li>
                                @if(isset($levels) && count($levels)>0)
                                @foreach($levels as $level)
                                <li><a href="#">{{$level->level_name}}</a></li>
                                @endforeach
                                @endif
                                <li><a href="#">Apply For A Job</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                            <h4><u>Feedback</u></h4>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <textarea placeholder="Description (Content must be less than 500 characters)" name="question" class="form-control" rows="7"></textarea>
                            <button type="button" class="btn btn-primary float-right mt-1">Proceed</button>
                        </div>
                    </div>
                    <div class="row">
                        <hr id="footer-hr">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xl-12 col-12">
                            <center>
                            <ul class="follow" id="menu">
                                <li>Follow Us On: </li>
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                            </ul>
                            </center>
                        </div>
                        <hr id="footer-hr">
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xl-12 col-12">
                            <center>
                            <label>
                                Copyright &copy 2020 <a href="#">PFS</a> All rights reserved. Developed by <a href="https://www.facebook.com/dangaura.tejendra">Sehzade Tezz</a> and powered by <a href="#">PFS Team</a>.
                            </label>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('scripts')
        <script type="text/javascript">
        $(document).ready(function(){
        $('#logout').on('click', function(e){
        e.preventDefault();
        $('#logoutForm').submit();
        });
        });
        </script>
    </body>
</html>