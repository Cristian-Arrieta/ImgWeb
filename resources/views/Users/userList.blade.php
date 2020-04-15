@if($users->count())

@foreach($users as $user)

<div  class="columnas profile-box border p-1 rounded text-center bg-light mr-4 mt-3">

<h5 class="m-0"><a href="{{ route('users.show', $user->id) }}">
<img src="{{$user->getPhotoRouteAttribute()}}" class="w-100 mb-1" style=" height: 200px;">

<span class="badge badge-primary">{{ $user->name }}</span></a></h5>

<p class="mb-2">

@if(Auth::check()&&(Auth::user()->id != $user->id))

	<small>Following: <span class="badge badge-primary">{{ $user->followings()->get()->count() }}</span></small>

<small>Followers: <span class="badge badge-primary tl-follower">{{ $user->followers()->get()->count() }}</span></small>
@endif										
		
	@can ('users.edit')
		<a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-outline-secondary"> <span class="oi oi-pencil">   Edit</a>
	@endcan
	@can ('users.destroy')
		{!!Form::open(['route' => ['users.destroy',$user->id],'method' => 'DELETE'])!!}
			<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?');">
				<span class="oi oi-trash">		Delete</span>
			</button>
		{!!Form::close()!!}	
	@endcan
</p>

@if(auth()->user() && auth()->user()->id != $user->id)
	<button class="btn btn-info btn-sm action-follow" data-id="{{ $user->id }}"><strong>

	@if(auth()->user()->isFollowing($user))

		UnFollow

	@else

		Follow

	@endif

	</strong></button>
@endif


</div>

@endforeach

@endif