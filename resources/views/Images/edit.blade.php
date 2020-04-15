@extends('layouts.app')


<link href="{{ asset('css/myCss.css') }}" rel="stylesheet">

<script src="{{ asset('js/tags.js') }}" ></script>

<script src="{{ asset('js/image.js') }}" ></script>


@section('content')



<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><CENTER>EDIT</center></div>					
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
				{!!Form::model($image,['route' =>['images.update',$image->id],              					'method'=>'PUT'])!!}
					@include('images.forms.formEdit')
				{!! Form::close() !!}
                	</div>
            </div>
        </div>
    </div>
</div>
@endsection
		