@extends('layouts.app')

@section('content')

@if(($users != null) && (count($users)> 9))
<div class="container">
@else
<div class="container full-height">	
@endif

	<div class="row justify-content-center">

		<div class="col-md-12">

			<div class="card">

				<div class="card-header"> <center><h4 style="font-size:25px;"  class="badge badge-pill badge-dark">Followings</h4></center> </div>

				<div class="card-body">
					
					<div class="row pl-5">
						
						@foreach ($users as $user)
						
							<div class="col-2 profile-box  p-1 rounded text-center  mr-4 mt-3">
								
								
								<h5 class="m-0">
								<a href="{{ route('users.show', $user->id) }}">
								<img src="{{$user->getPhotoRouteAttribute()}}" class="rounded w-100 mb-1">
								<strong class="badge badge-pill badge-primary norm_word">{{ $user->name }}</strong></a></h5>
								
							</div>
						
						@endforeach
						
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@endsection