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

				<div class="card-header d-flex justify-content-between align-items-end mb-2">
					<h4 style="font-size:25px;"  class="badge badge-pill badge-dark">Favorites</h4> 
					<div class="row">
						<div class= "col-md-12">
							<div class="page-header">
								
									
									{{ Form::open(['route' => 'favorites.filtro','method' => 'GET','class' => 'form-inline pull-right'])}}
										
										<div class="form-group">
										{{ Form::text('name',null,['class' => 'form-control' , 'placeholder' => 'Name'])}}
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-secondary">
												<span class="oi oi-magnifying-glass"></span>
											</button>
										</div>
									{{ Form::close() }}
								
							</div>
						</div>
					</div>
				</div>

				<div class="card-body">
					
					<div class="row pl-5">
						@foreach ($images as $image)
							<div class="col-2 profile-box  p-1 rounded text-center  mr-4 mt-3">
								
								<h5 class="m-0"><a href="{{ route('images.show', $image->id) }}">
								<img src="{{$image->getPhotoRouteAttribute()}}" class="img-fluid rounded w-100 mb-1">
								<strong><span class="badge badge-dark">{{ $image->name }}</span></strong></a></h5>
								<h5 class="m-0"><a href="{{ route('users.show', $image->users->id) }}"><strong>
								<span class="badge badge-primary">{{ $image->users->name }}</span></strong></a></h5>
								
							</div>
						
						@endforeach
						
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@endsection