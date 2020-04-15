<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LvArt') }}</title>

    <!-- Scripts -->

<script src="{{ asset('js/app.js') }}" defer></script> 
	

 @section('miScript')
    <!--  Scripts  
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	-->
	<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" ></script> 
  @show


  <!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
-->

  <!--	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous" ></script>
   CUIDADO era el ultimo script antes--> 

<script src="{{ asset('js/miScriptMenu.js') }}" ></script> 
<script src="{{ asset('js/reload.js') }}" ></script>
<script src="{{ asset('js/noti_read.js') }}" ></script> 


<!--  Quitar en caso de fallas (Galleria)  -->
<style type="text/css">
    @media (min-width: 768px) {
    .carousel-multi-item-2 .col-md-3 {
    float: left;
    width: 25%;
    max-width: 100%; } }
    
    .carousel-multi-item-2 .card img {
    border-radius: 2px; }
	
		.columnas{flex:0 0 16.6666666667%;max-width:16.6666666667%}
	
	@media only screen and (max-width: 950px)
	{
		.columnas{flex:0 0 25%;max-width:25%}
	}
    </style>	
    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    
    <style>
    	.imgRedonda {
    	    width:300px;
    	    height:300px;
    	    border-radius:160px;
    	    border:10px solid #666;
    	}
    	.imgRedonda2 {
    	    	    width:50px;
    	    	    height:50px;
    	    	    border-radius:100px;
    	    	    border:3px solid #666;
    	    	}
		body {
                background-color: black;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
				background-image: url("{{asset('img/users/cubic_color.jpg')}}");
		
					background-repeat: no-repeat;
					background-size: cover;
						-moz-background-size: cover;
						}	
		.contorno{
			background-image: url("{{asset('img/users/portfolio-01.jpg')}}");
			background-size: cover;
			-moz-background-size: cover;
			-webkit-background-size: cover;
			-o-background-size: cover;}			
		
		footer {
			font-size: 15px;
			background-color:green;
            position: relative;
            margin-top: -50px;
           
            padding:5px 0px;
            clear: both;
            text-align: center;
            color: black;
        }		
		.full-height {
                height: 100vh;
            }
    </style>
    

    <!-- Styles 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	-->
     <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css" integrity="sha256-CNwnGWPO03a1kOlAsGaH5g8P3dFaqFqqGFV/1nkX5OU=" crossorigin="anonymous" />
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<link href="{{ asset('css/MyCssMenu.css') }}" rel="stylesheet">
	
</head>
<body >
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
		<!-- Menu Lateral -->
			<div id="mySidenav" class="sidenav">
			
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  		
				<li>
						<a class="nav-link"  href="{{route('users.index')}}"><span class="oi oi-person"></span> Users</a>
				</li>
					
				@if(Auth::check())
					
					<li>
						<a class="nav-link"  href="{{route('images.create')}}"> <span class="oi oi-data-transfer-upload"></span> Upload</a>
					</li>
				
					<li>
						<a class="nav-link"  href="{{route('images.ranking')}}"><span class="oi oi-badge"></span> Ranking</a>
					</li>
					
					<li>
						<a class="nav-link"  href="{{route('images.favorites')}}"><span class="oi oi-star "></span> Favorites</a>
					</li>
				
					<li>
						<a class="nav-link"  href="{{route('users.followings')}}"><span class="oi oi-people"></span> Followings</a>
					</li>
				
					<li>
						<a class="nav-link"  href="{{route('users.followers')}}"><span class="oi oi-people  icon-flip:horizontal"></span> Followers</a>
					</li>
				
				
					@can('roles.index')	
						<li>
							<a class="nav-link"  href="{{route('roles.index')}}"><span class="oi oi-monitor"></span>  Roles</a>
						</li>
					@endcan
				@endif
			</div>
			
			<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>	
						
			<a class="navbar-brand" href="{{ route('home') }}" style="font-size:30px;cursor:pointer;margin-left: 20px;">
               <img src="{{asset('img/users/lvart2.png')}}"  width="150" height="80">     
            </a>	
		<!-- Fin del Menu Lateral -->
		
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
					<ul class="navbar-nav m-auto">
						{{ Form::open(['route' => 'filtro','method' => 'GET','class' => 'form-inline'])}}
										
							<div class="wrap">
								<div class="search">
									{{ Form::text('search',null,['class' => 'searchTerm' , 'placeholder' => 'Search...'])}}
							
									<button type="submit" class="searchButton">
										<i class="fa fa-search"></i>
										<span class="oi oi-magnifying-glass"></span>
									</button>
								</div>
							</div>
						
						{{ Form::close() }}
					</ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
					
					</ul>
					<ul class="navbar-nav ml-auto">					
					</ul>
					<ul class="navbar-nav ml-auto">
					@if(Auth::check())
					<li>			
						<div   class="btn-group" style="position:relative" id="notifyc">
									<button id="buttonRead" href="{{route('users.index')}}" class="dropdown-toggle btn btn-primary" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" type="button">							
										<img src="{{asset('img/icono.png')}}" />
										<span id="countNoty" class="badge badge-light">{{count(Auth::user()->unreadNotifications)}}</span>										
									</button>										
									<div class="dropdown-menu">
										@foreach (Auth::user()->Notifications as $notification)
										<?php $user = App\User::find($notification->data['user_id']);?>
												<a class="dropdown-item"href="{{ route('images.show', $notification->data['post']) }}">
													
													<img class="imgRedonda2" src="{{($user->getPhotoRouteAttribute())}}" alt="Tu imagen de perfil" width="30" height="40">
												
													<b>{{ $notification->data['user_name'] }} : </b><i>{{ $notification->data['mensaje'] }}</i>
												</a>
											
											<div class="dropdown-divider"></div>
											
										@endforeach
									</div>									
						</div>      
					</li>
					@endif
					</ul> 
					<ul class="navbar-nav ml-auto">										 
					
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
				    
				    <img class="imgRedonda2" src="{{(Auth::user()->getPhotoRouteAttribute())}}" alt="Tu imagen de perfil" width="30" height="40">
				    <span class="caret"></span>
				    
                                </a>

				
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.show',Auth::user()->id) }}">
                                        {{ __('Perfil') }}
                                    </a>
								
                              
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
							
							<li class="nav-item">
  
</li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
		<main class="py-1" style="background-color:black;"></main>
		<main class="py-4 " >
				@if(session('info'))
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-8 col-md-offset-2">
								<div class="alert alert-success">
									{{ session('info')}}
								</div>
							</div>
						</div>
					</div>		
				@endif
				@if(session('alert'))
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-md-8 col-md-offset-2">
								<div class="alert alert-danger">
									{{ session('alert')}}
								</div>
							</div>
						</div>
					</div>		
				@endif	
            @yield('content')
        </main>
    </div>
	

</body>
		
</html>
