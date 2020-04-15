<div class="modal fade" id="Followings">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Followings</h4>
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

							<img src="{{$user->getPhotoRouteAttribute()}}" class="w-100 mb-1">

							<h5 class="m-0"><a href="{{ route('users.show', $user->id) }}"><strong>{{ $user->name }}</strong></a></h5>

							


						</div>

					@endforeach

					@endif
				</div>
			</div>
		</div>
	</div>
</div>