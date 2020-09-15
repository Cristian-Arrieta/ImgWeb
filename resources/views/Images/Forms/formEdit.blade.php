<div class="form-group">
	{{ Form::label('name','Name') }}
	{{ Form::text('name',null,['class' => 'form-control']) }}
</div>		



<div class="form-group">
	<label for="validationCustom04">Image</label >
	<center>
	
	@if(!empty($image))
	<img id="uploadForm" class="zoom" src="{{($image->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="100%" height="%100">
	@else
	<img id="uploadForm"  alt="imagen" width="100%" height="%100" >
	
	@endif
	
	</center>
</div>

<div class="form-group">
	{{ Form::label('description','Description') }}
	{{ Form::textarea('description' , null ,['class' => 'form-control']) }}
</div>
<hr noshade="noshade" />

<h3>Tags</h3>
<div class="ui-tag-container">
	<ul class="tags">
		@foreach($tags as $tag)
			<li class="close">
				<span class="_icon-text">{{ $tag }}</span>
			</li>
		@endforeach	
	</ul>
	<input name="tags" id ="tag" type="text" value="" maxlength="30" placeholder="Tags" class="" onkeypress="return num(event);" > 
	
</div>
<div class="form-group"><center>
			<p class="text-muted">*To load a Tag press "Space" or "Enter"</p></center>
	</div>


<div class="form-group">
	{{ Form::submit('Guardar',['class' => 'btn  btn-primary','id' => 'ok']) }}
</div>