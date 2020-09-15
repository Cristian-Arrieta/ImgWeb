
@extends('layouts.app')

    <!-- Jquery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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
        <div class="col-md-10">
            <div class="card">
                
					@if($errors->any())
						<div class="alert alert-danger">
							<h5>Please Complete the Following Fields Correctly</h5>
							<ul>
								@foreach($errors->all() as $error)
												
									<li>{{$error}}</li>
												
								@endforeach
							</ul>
						</div>
					@endif	
                <div class="card-body">
                			{!!Form::model($user,['route' =>['users.update',$user->id],'files' => true,
                					'method'=>'PUT'])!!}
                				@include('users.forms.formData')
								@can('roles.edit')
									@include('users.forms.formRole')
								@endcan
                				<div class="form-group">
                					{{ Form::submit('Save',['class' => 'btn btn-primary']) }}
                				</div>				
                								
                			{!! Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
