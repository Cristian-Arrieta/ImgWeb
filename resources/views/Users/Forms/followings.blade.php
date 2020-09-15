<div class="modal fade" id="Followings">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 style="font-size:25px;"  class="badge badge-pill badge-dark">Followings</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row pl-5">
				<?php $users = $user->Followings()->get();?>
				@if($users->count())	
					@foreach( $users as $user)
						
						<div class="col-2 profile-box border p-1 rounded text-center bg-light mr-4 mt-3">
						<a href="{{ route('users.show', $user->id) }}">
							<img src="{{$user->getPhotoRouteAttribute()}}" class="w-100 mb-1" style="height:75;">

							<h5 class="m-0"><strong>{{ $user->name }}</strong></h5>
						</a>
						</div>
						
					@endforeach

					@endif
				</div>
			</div>
		</div>
	</div>
</div>