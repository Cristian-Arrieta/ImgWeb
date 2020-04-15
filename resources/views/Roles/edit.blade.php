@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Role</div>
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
                	{!! Form::model($role,['route' => ['roles.update',$role->id],
                			'method'=>'PUT']) !!}
                		@include('roles.forms.form')
                	{!! Form::close() !!}
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
				
				
				