@if($images->count())

@foreach($images as $image)

<div class="columnas profile-box border p-1 rounded text-center bg-light mr-4 mt-3 ">

<h5 class="m-0" ><a href="{{ route('images.show', $image->id) }}">
<img src="{{$image->getPhotoRouteAttribute()}}" class="w-100 mb-1 img-fluid" style=" height: 200px;">

<span class="badge badge-dark" style="margin:5px">{{ $image->name }}</span></a></h5>

<p class="mb-2">

	@can ('images.edit')
		<a href="{{ route('images.edit',$image->id) }}" class="btn btn-sm btn-outline-secondary"> <span class="oi oi-pencil">   Editar</a>
	@endcan
	@can ('images.destroy')
		{!!Form::open(['route' => ['images.destroy',$image->id],'method' => 'DELETE'])!!}
			<button class="btn btn-sm btn-outline-danger">
				<span class="oi oi-trash">		Eliminar</span>
			</button>
		{!!Form::close()!!}	
	@endcan
</p>



</div>

@endforeach

@endif