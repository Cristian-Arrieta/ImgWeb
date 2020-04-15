<div class="form-group">
	{{ Form::label('name','Role Name') }}
	{{ Form::text('name',null,['class' => 'form-control'])}}
</div>
<div class="form-group">
	{{ Form::label('slug','Friendly URL') }}
	{{ Form::text('slug',null,['class' => 'form-control'])}}	
</div>
<div class="form-group">
	{{ Form::label('description','Role Description') }}
	{{ Form::textarea('description',null,['class' => 'form-control'])}}	
</div>
<hr>
	<h3>Special Permissions</h3>
	<div class="form-group">
		<label>{{Form::radio('special','all-access')}} Total Access</label>
		<label>{{Form::radio('special','no-access')}} No Access</label>
	</div>
		<h3>Permit List</h3><hr noshade="noshade" />
		<div class="form-group">
			<ul class="list-unstyled">
				@foreach($permissions as $permission)
					<li>
						<label>
							{{ Form::checkbox('permissions[]',$permission->id,null)}}
							{{ $permission->name}}-->
							<em>({{ $permission->description ?: 'N/A'}})
							
						</label><hr noshade="noshade" />
					</li>
				@endforeach
			</ul>
		</div>
</hr>
<div class="form-group">
	{{ Form::submit('Save',['class' => 'btn  btn-primary']) }}
</div>