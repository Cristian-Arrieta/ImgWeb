@extends('layouts.app')
<link href="{{ asset('css/gallery3.css') }}" rel="stylesheet">
<style>
	figure {
		filter: opacity(70%);
	}
	figure:hover {
            transition: .5s ease;
            filter: opacity(100%);
        }

</style>
@section('content')

<script src="{{ asset('js/custom.js') }}" ></script>
<script src="{{ asset('js/gallery.js') }}" ></script>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
			<!--"card-header d-flex justify-content-between align-items-end mb-2"-->
                <div class="card-header d-flex justify-content-between  mb-2">
				
						<a style="font-size:15px;" class="badge badge-pill badge-secondary" href="{{route('users.show',$user->id)}}">	
						<img class="imgRedonda2" src="{{($user->getPhotoRouteAttribute())}}" alt="Tu imagen de perfil" width="30" height="40">			
						{{$user->name}}	</a>							
						@if(auth()->user() && auth()->user()->id != $user->id)	
							<button style="font-size:20px;" class="btn badge badge-pill badge-primary action-follow " data-id="{{ $user->id }}">
								<strong>

								@if(auth()->user()->isFollowing($user))

									UnFollow

								@else

									Follow

								@endif

								</strong>
							</button>
						@endif						
					
					@if(Auth::check())
						<nav class="navbar navbar-expand-lg navbar-light bg-light">

						<div class="collapse navbar-collapse" id="navbarSupportedContent">
						  <ul class="navbar-nav mr-auto">
							
							<li class="nav-item dropdown">
							  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  
								<span class="oi oi-ellipses"></span>
								
							  </a>
							  <div class="dropdown-menu" aria-labelledby="navbarDropdown">

							  @if(( Auth::user()->can('users.edit')||($user->id == Auth::user()->id)))
								<a class="dropdown-item" href="{{route('users.edit',$user)}}">Edit</a>
							  @endif		
								
							  @if (Auth::user()->can('users.destroy') ||($user->id == Auth::user()->id))
							  
								<div class="dropdown-divider"></div>
								
								{!! Form::open(['route' => ['users.destroy',$user->id],'method' => 'DELETE'])!!}					
									<button class="dropdown-item" onclick="return confirm('Esta seguro que desea Eliminar este Perfil? ')"><span class="oi oi-trash"> Delete </button>
								{!! Form::close() !!}
							  @endif
							  
							  </div>
							</li>
						  </ul>
						</div>
					  </nav>		
					@endif	
				</div>
				
                <div class="card-body">
				
				<table style="margin: 0 auto;" cellpadding="5">
				<tr >
					<td colspan="2" style="text-align:center;">
						<h4  class="badge badge-pill badge-dark big_word"><strong>Email : </strong>{{$user->email}}</h4>
					</td>
					
				</tr>
				<tr>	
					<td width="70%">
						<h5 ><a class="badge badge-pill badge-success norm_word" href="" data-toggle="modal" data-target="#Followers">
						<strong>Followers : </strong>{{$user->Followers()->get()->count()}}</a></h5>
					</td>
					<td >
						<h5><a class="badge badge-pill badge-success norm_word" href="" data-toggle="modal" data-target="#Followings">					
						<strong>Following : </strong>{{$user->Followings()->get()->count()}}</a></h5>
					</td>
					
					
				</tr>
				</table>
					@include('Users.Forms.followers')
					@include('Users.Forms.followings')				
				<center>
				<img class ="imgRedonda img-fluid w-auto mb-2" src="{{($user->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="300" height="400">
				</center>
				<br><br>
				<center> <h2 class="badge badge-pill badge-dark big_word">GALLERY<h2> </center>
				
				<br><br>
				
				<!--
				<section id="galeria">
				@foreach ($images as $image)
				
				       <article>
							<a  href="{{route('images.show',$image->id)}}">
								<figure>
									<img src="{{$image->getPhotoRouteAttribute()}}" class="rounded img-fluid w-100 mb-2">
									<h4 class="badge badge-light big_word">{{$image->name}}</h4>
								</figure>
							</a>
						</article>		
				

				@endforeach			
				</section>
				-->
				
				<div style="text-align:right">					
					<button class="btn" type="button" onclick="btnCol()">
						<span id="spCol" class="oi oi-grid-three-up" >
					</button>
					<button class="btn" type="button" onclick="btnRow()">
						<span id="spRow" class="oi oi-list">
					</button>
				</div>
				<br><br>
				
				<div class="row" id="galeria">
					@foreach ($images as $image)
					
					<div class="col-md-3 mb-3 CR">
						<article>
							<a  href="{{route('images.show',$image->id)}}">		
							<figure>
								<center>
									<img src="{{$image->getPhotoRouteAttribute()}}" class="rounded img-fluid w-100 mb-2">
									<h4 class="badge badge-light nor_word">{{$image->name}}</h4>
								</center>
							</figure>
							</a>
						</article>
					</div>
					
					@endforeach			

				</div>

            </div>
        </div>
		{{$images->render()}}
    </div>
</div>
</div>
@endsection