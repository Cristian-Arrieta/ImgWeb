@extends('layouts.app')
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
<script src="{{ asset('js/likes.js') }}" ></script>
<script src="{{ asset('js/favorites.js') }}" ></script>
<script src="{{ asset('js/comment.js') }}" ></script>
<script src="{{ asset('js/seeMore.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
				<div class="card-header d-flex justify-content-between  mb-2">
				<a style="font-size:15px;" class="badge badge-pill badge-secondary" href="{{route('users.show',$user->id)}}">	
			<img class="imgRedonda2" src="{{($user->getPhotoRouteAttribute())}}" alt="Tu imagen de perfil" width="30" height="40">			
				{{$user->name}}</a>
			@if(auth()->user() && auth()->user()->id != $user->id)	
				<button style="font-size:20px;" class="btn badge badge-pill badge-primary action-follow " data-id="{{ $user->id }}"><strong>

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

				  @if(Auth::user()->can('images.edit')||($image->users->id == Auth::user()->id))
					<a class="dropdown-item" href="{{route('images.edit',$image)}}">Edit</a>
					
				  @endif		
					
				  @if(Auth::user()->can('images.destroy')||($image->users->id == Auth::user()->id))
				  
					<div class="dropdown-divider"></div>
					
					{!! Form::open(['route' => ['images.destroy',$image->id],'method' => 'DELETE'])!!}					
						<button class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?');" ><span class="oi oi-trash"> Delete</button>
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
			
			<center>
				<!--	<img src="data:image/jpg; base64 , {{($image->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="300" height="400"> -->
				<img class="zoom img-fluid rounded " src="{{($image->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="100%" height="%100">
				
			</center>
			<br>
			
			
			<div class="list-group">
			  <a  class="list-group-item list-group-item-action list-group-item-primary" style=" color: #1B4F72;">
			  <span class="oi oi-bookmark  "></span> <b> Name : {{$image->name}}</b></a>
			 @if ($image->description != null)	 	
				<a  class="list-group-item list-group-item-action list-group-item-secondary">
				<span class="oi  oi-justify-left "></span> <b>Description : </b>{{$image->description}}</a>
			 @endif
			 <li  class="list-group-item list-group-item-action list-group-item-success">
			
			{{ Form::open(['route' => 'filtro','method' => 'GET','class' => 'form-inline pull-right'])}}
			<span class="oi oi-tags "></span> Tags : 
			@foreach ($tags as $tag)
				
				<button type="submit" class="btn btn-link btn-sm" name="search" value="{{$tag}}" 
				style=" color: #0E6251;">
							 <b>	{{$tag}}</b>
				</button>
			  @endforeach
			  
			{{ Form::close() }}
			
			  </li>
			  <a id="imgtype" class="list-group-item list-group-item-action list-group-item-danger" style=" color: #7B241C;">
				<span class="oi oi-flag "></span> <b>Type : {{$image->type}}</b></a>
			  <a  class="list-group-item list-group-item-action list-group-item-warning" style=" color: #9A7D0A;">
				<span class="oi oi-resize-width "></span> <b>Width : {{$image->width}}</b></a>
			  <a  class="list-group-item list-group-item-action list-group-item-info" style=" color: #21618C;">
				<span class="oi oi-resize-height "></span> <b>Height : {{$image->height}}</b></a>
			  <a  class="list-group-item list-group-item-action list-group-item-light" style=" color: #717D7E;"> 
				<span class="oi oi-clock "></span><b> Date : {{$image->date}}</b></a>
			  <a href="{{route('images.download',$image->id)}}" class="list-group-item list-group-item-action list-group-item-dark" style=" color: #17202A;"><span class="oi oi-data-transfer-download "></span>
			  <b>Download</b></a>
			</div>			

		<div class="card-footer">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav ml-auto">
				@if(Auth::check())
					<button id="action-like"  class="btn btn-success btn-sm" style="margin-right: 10px;" data-id="{{ $image->id }}">
					
						<span class="oi oi-thumb-up" data-inline="false"></span>
						<strong >
                        @if (! $image->isLikedBy(Auth::user()))
								
							Like : 
								
                        @else                            
								
							 UnLike :  
							 
						@endif
						</strong>
						<b id="like_count">{{ $image->likers()->count() }}</b>
					</button>		
					
                        
					<button id="action-favorite" class="btn btn-info btn-sm" data-id="{{ $image->id }}">
							<span class="oi oi-star" data-inline="false"></span>	
						<strong>	
						@if (! $image->isFavoritedBy(Auth::user()))				
							 Favorite 
                        @else
                             UnFavorite
                        @endif
						</strong>
					</button>	
				@endif			
				</ul>
			</div>
			</nav>
        </div>

					@if(count($images) > 3)
						<!--Carousel Wrapper-->
									<div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel">
									
									  <!--Controls-->
									  <div class="controls-top">
									    <a class="black-text" href="#multi-item-example" data-slide="prev"><i class="fas fa-angle-left fa-3x pr-3"></i></a>
									    <a class="black-text" href="#multi-item-example" data-slide="next"><i class="fas fa-angle-right fa-3x pl-3"></i></a>
									  </div>
									  <!--/.Controls-->
									
									  <!--Slides-->
									  <div class="carousel-inner" role="listbox" style="height:250">
									
									    <!--First slide-->
									    <div class="carousel-item active" >
									
									
										@for($i = 0 ; $i < 4 ; $i++)
															
														
											<div class="col-md-3 mb-3">
												<figure>
												 	<a href="{{route('images.show',$images[$i]->id)}}">
													<center>
														<img class="img-fluid rounded  w-auto mb-2" src="{{($images[$i]->img_min())}} "  alt="Card image cap">
													</center>
													<h4 class="text-center badge-light big_word">{{$images[$i]->name}}</h4>
													</a>
												</figure>
											</div>
															
										@endfor
									    </div>
									    <!--/.First slide-->
									
										
										@if(count($images) > 7)						
										
									    <!--Second slide-->
									    <div class="carousel-item">
									
									      @for($i = 4 ; $i < 8; $i++)
									      											
									      	<div class="col-md-3 mb-3">
									      	<figure>
										        <a href="{{route('images.show',$images[$i]->id)}}">
													<center>
														<img class="img-fluid rounded  w-auto mb-2" src="{{($images[$i]->img_min())}} "  alt="Card image cap">
													</center>
													<h4 class="text-center  badge-light big_word">{{$images[$i]->name}}</h4>
													</a>
											</figure>  
									      	
									      	</div>
									      											
									      @endfor
									
									    </div>
									    <!--/.Second slide-->
									
									   @endif
									    					    
									
									  </div>
									  <!--/.Slides-->
									
									</div>
				
							@endif
		<br>
			 <label for="comment">Comment:</label><br>
				@if(Auth::guest())
								
					<center><strong><u><a style="color:black" href="{{ route('login') }}"> Please log in to your account to comment.</a></u></strong>
							<br><br>
				@else
					<div class="row">
					<table class="table">
						<tr>
						<div class="col-md-1">
						<td>
							<img class="imgRedonda2" src="{{(Auth::user()->getPhotoRouteAttribute())}}" alt="Tu imagen de perfil" width="30" height="40">
						</td>	
						</div>
						
						<div class="col-md-10">
							<td style="width:100%">
							
							
								
								
									<div class="form-group">
										
										<textarea id="imgcomm"rows="5" name="comment" class="form-control"></textarea>
										
									</div>
									
									<div class="form-group">
										
										<button id="Post_comment" type="submit" data-id="{{ $image->id }}"
										class="btn btn-primary" >Post comment</button>															
									</div>
									
								
							
							
							</td>
						</div>
						</tr>
					</table>
					</div>
			 @endif
			 
				<div  id="imgtable"class="row-card" >
				<table class="table table-hover" id="comments" >
					<div class="col-md-12" id="secdiv">
					
						@foreach ($comments as $comment)
							<tr >
							<div class="row" >
							
								<div class="col-md-1">
								<td >
									<img class="imgRedonda2" src="{{($comment->users->getPhotoRouteAttribute())}}" alt="Tu imagen de perfil" width="30" height="40">
									</td>
								</div>
								
								<div class="col-md-10">
									<td style="width:100%">
										
										<strong>{{$comment->users->name}} : </strong>
										{{$comment->text}} - 
										{{$comment->created_at->diffForHumans()}}
										
									</td>
									<td>
											
										@if(Auth::check())
											
											<nav class="navbar navbar-expand-lg navbar-light bg-light">
												<div class="collapse navbar-collapse" id="navbarSupportedContent">
												  <ul class="navbar-nav mr-auto">											
													<li class="nav-item dropdown">
													  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														
													  </a>
													  <div class="dropdown-menu" aria-labelledby="navbarDropdown">

													  @if(Auth::user()->id == $comment->users->id ||
													  Auth::user()->can('comments.edit'))
													  <?php $modal = $comment->id ?>
															
														<a class="dropdown-item" data-toggle="modal" data-target="#editComment{{$comment->id}}" >Edit</a>
														<div class="dropdown-divider"></div>
														
													  @endif
													   
													  @if(Auth::user()->id == $comment->users->id || $image->users->id == Auth::user()->id ||
													  Auth::user()->can('comments.destroy'))
														
														{!! Form::open(['route' => ['comments.destroy',$comment->id],'method' => 'DELETE'])!!}
															
															<button class="dropdown-item">Delete</button>
															<div class="dropdown-divider"></div>
															
														{!! Form::close() !!}
														
													  @endif
															
														<a class="dropdown-item" href="{{route('users.show',$comment->users)}}">Visit</a>	
															
													  </div>
													</li>
												  </ul>
												</div>
											</nav>
										@endif
										@include('Images.Comments.edit')	
									</td>	
								</div>
							</div>
							</tr>	
														
						@endforeach
					
									
					</div>
				</table>
				
				
				</div>
				<center><button id ="see-more" class="btn btn-outline-secondary">See More</button></center>
				{{$comments->render()}}
            </div>
        </div>
    </div>
</div>



@endsection