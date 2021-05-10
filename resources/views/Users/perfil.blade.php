@extends('layouts.app')

<script>
function init() {
  var inputFile = document.getElementById('file');
  inputFile.addEventListener('change', mostrarImagen, false);
}

function mostrarImagen(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('uploadForm');
    img.src= event.target.result;
  }
  reader.readAsDataURL(file);
}

window.addEventListener('load', init, false);

</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end mb-2">
		Usuario
		</div>
					@if($errors->any())
						<div class="alert alert-danger">
							<h5>Por favor completar correctamente los siguientes Campos</h5>
							<ul>
								@foreach($errors->all() as $error)
												
									<li>{{$error}}</li>
												
								@endforeach
							</ul>
						</div>
					@endif	
                <div class="card-body">
                			{!!Form::model($user,['route' =>['users.perfil_update',$user->id],'files' => true,
                					'method'=>'PUT'])!!}
                				@include('users.forms.formData')
                				<div class="form-group">
                					{{ Form::submit('Guardar',['class' => 'btn btn-primary']) }}
                				</div>				
                								
                			{!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('miScript')

    <!-- Jquery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
@endsection

