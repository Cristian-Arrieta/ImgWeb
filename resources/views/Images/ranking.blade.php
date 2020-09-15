@extends('layouts.app')

@section('content')


@if(($images != null) && (count($images)> 5))
<div class="container">
@else
<div class="container full-height">	
@endif

	<div class="row justify-content-center">

		<div class="col-md-12">

			<div class="card">

				<div class="card-header"> <center><h4 style="font-size:25px;"  class="badge badge-pill badge-dark">Popularity Ranking</h4></center> </div>

				<div class="card-body">
					
					<div class="row pl-5">
						<?php $count = 0;?>
						@foreach ($images as $image)
						<?php $count ++?>
							<div class="col-2 profile-box  p-1 rounded text-center  mr-4 mt-3">
								
								<h3>#{{$count}}<h3>
								
								<h5 class="m-0"><a href="{{ route('images.show', $image->id) }}">
								<img src="{{$image->getPhotoRouteAttribute()}}" class="img-fluid rounded w-100 mb-1">
								<strong><span class="badge badge-dark">{{ $image->name }}</span></strong></a></h5>
								<h5 class="m-0"><a href="{{ route('users.show', $image->users->id) }}"><strong>
								<span class="badge badge-primary">{{ $image->users->name }}</span></strong></a></h5>
								<h5 class="badge badge-success">Likes: ({{$image->likers()->count()}})<h5>
								
							</div>
						
						@endforeach
						
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@endsection