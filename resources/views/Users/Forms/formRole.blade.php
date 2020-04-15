<h3>List of Roles</h3>
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $role)
			<li>
				
            <div class="custom-control custom-radio">
			<input class="form-check-input" type="radio" name="roles" value="{{$role->id}}"
				@if((count($user->roles->all()) > 0)&& ($role->id == $user->roles[0]->id))
                 checked						  
				
				@endif
				><label class="form-check-label" for="exampleRadios1">
									{{$role->name}}
								  </label>
            </div>
            
			</li>
		@endforeach
	</ul>
</div>
</hr>