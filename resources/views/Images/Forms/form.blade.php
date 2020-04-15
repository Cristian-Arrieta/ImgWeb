<div class="form-group">
	{{ Form::label('name','Name') }}
	{{ Form::text('name',null,['class' => 'form-control']) }}
	
	
</div>

<div class="form-group">
	<center>
	
	@if(!empty($image))
		<img id="uploadForm" class="zoom img-fluid rounded" src="{{($image->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="100%" height="%100">
	@else
		<img class="zoom img-fluid rounded" id="uploadForm"  alt="imagen" width="%100" height="%100" src="{{asset('img/images.png')}}">	
	@endif
	
	</center>
</div>
<div class="input-group mb-3">
            <div class="custom-file">
                <input name="img" type="file" class="custom-file-input" id="file" onchange ="Nombre()"/>
                <label class="custom-file-label" for="file" id="textFile">Choose file</label>
            </div>
           
</div>

<div class="form-group"><center>
		<p class="text-muted">*png , jpg , jpeg ,gif</p></center>
</div>

<script>
  function Nombre(){
		
		 $("#textFile").text($("#file").val());
		
	}
</script>

<br><br>



<div class="ui-tag-container">
	<ul class="tags">
		<li data-tag="sdf" class="close">
			<!-- <span class="_icon-text">sdf</span> -->
		</li>
	</ul>
	<input name="tags" id ="tag" type="text" value="" maxlength="30" placeholder="Tags" class="" onkeypress="return num(event);" > 
	
</div>
	
	<div class="form-group"><center>
			<p class="text-muted">*To load a Tag press "Space" or "Enter"</p></center>
	</div>


<div class="form-group">
	{{ Form::label('description','Description ') }}
	{{ Form::textarea('description' , null ,['class' => 'form-control']) }}
</div>
<hr noshade="noshade" />


<div class="form-group">
	{{ Form::submit('Post',['class' => 'btn  btn-primary','id' => 'ok']) }}
</div>