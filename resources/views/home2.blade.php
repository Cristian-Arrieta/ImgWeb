@extends('layouts.app')
<link href="{{ asset('css/gallery2.css') }}" rel="stylesheet">

@section('content')

@if(($images != null) && (count($images)> 3))
<div class="container ">
@else
<div class="container full-height ">	
@endif

	<div class="row justify-content-center">

		<div class="col-md-10">

			<div class="card">

				<div class="card-header"> <center><h4 class="badge badge-pill badge-dark big_word">Let your imagination fly</h4></center> </div>

				<div class="card-body">
					
					<div class="row pl-2">
						
					
				<section id="galeria">
				@foreach($images as $image)
							
						<article>
							
								<figure>
								<h4 class="text-center my-3">
									<a href="{{ route('images.show', $image->id) }}">
									<img src="{{$image->getPhotoRouteAttribute()}}" class="rounded img-fluid w-100 mb-2">
								<span class="badge badge-dark">{{ $image->name }}</span></a></h4>
								<h4 class="text-center my-3"><a href="{{ route('users.show', $image->users->id) }}">
								<span class="badge badge-primary">{{ $image->users->name }}</span></a></h4>
								
								</figure>
							
						</article>		
							
						
						@endforeach
					</section>
					</div>

				</div>
				<div >
				
				</div>
			</div>
{{ $images->links() }}
		</div>

	</div>

</div>
<main class="py-5" style="background-color:black;"></main>
		<footer class="flex-center position-ref  med-height  contorno">
			<div class="container" >
				<div class="row">
					<div class="col-md-5">
						<h1 class="footer-logo">
							<img src="{{asset('img/users/lvart2.png')}}" alt="PPEA" width="150" height="100">
						</h1>
						<p>Let your imagination fly</p>
					</div>
					<div class="col-md-7 ">
						<ul class="footer-nav ">
							<li><a href="https://www.facebook.com/" style="color: white; font-size: 16px; "> <img src="{{asset('img/users/facebook.png')}}" alt="Tu imgen de perfil" width="30" height="30" >Facebook</a></li>
							<li><a href="https://twitter.com/"style="color: white; font-size: 16px; "><img src="{{asset('img/users/twitter.png')}}" alt="Tu imgen de perfil" width="30" height="30" >Twitter</a></li>
							<li><a href="https://www.youtube.com"style="color: white; font-size: 16px; "><img src="{{asset('img/users/youtube.png')}}" alt="Tu imgen de perfil" width="30" height="30" >Youtube</a></li>
							<li><a href="https://www.instagram.com/"style="color: white; font-size: 16x; "><img src="{{asset('img/users/instagram.png')}}" alt="Tu imgen de perfil" width="30" height="30" >Instagram</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	<main class="py-3" style="background-color:black;"></main>
@endsection