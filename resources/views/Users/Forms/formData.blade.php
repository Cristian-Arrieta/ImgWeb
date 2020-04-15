<div class="form-group">
	{{ Form::label('name','Username')}}
	{{ Form::text('name',null,['class' => 'form-control'])}}
</div>

<div class="form-group">
	{{ Form::label('email','E-mail')}}
	{{ Form::text('email',null,['class' => 'form-control'])}}
</div>
<div class="form-group">
	{{ Form::label('password','Password')}}
	{{ Form::password('password',['class' => 'form-control'])}}
</div>

<!--
<div class="form-group">
	{{ Form::label('Fecha','Fecha de Nacimiento')}}
	<input type="text" class="form-control datepicker" name="fecha">  
</div>
-->

<div class="form-group">
	<label for="validationCustom04">Profile Picture</label>
	<center>
	<!--	<img src="data:image/jpg; base64 , {{($user->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="300" height="400"> -->
		<img class="imgRedonda" id="uploadForm" src="{{($user->getPhotoRouteAttribute())}} " alt="Tu imgen de perfil" width="300" height="400">
	</center>
</div>

<div class="input-group mb-3">
            <div class="custom-file">
                <input name="photo" type="file" class="custom-file-input" id="file" onchange ="Nombre()"/>
                <label class="custom-file-label" for="file" id="textFile">Choose file</label>
            </div>
           
</div>
<div class="form-group"><center>
<p class="text-muted">Upload a photo for your profile</p></center>

</div>
<script>
  function Nombre(){
		
		 $("#textFile").text($("#file").val());
		
	}
</script>


