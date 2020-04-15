@extends('layouts.app')

@section('content')

<script src="{{ asset('js/custom.js') }}" ></script>

@if(($users != null) && (count($users)> 9))
<div class="container ">
@else
<div class="container full-height ">	
@endif

	<div class="row justify-content-center">

		<div class="col-md-12">

			<div class="card">

				<div class="card-header d-flex justify-content-between align-items-end mb-2">
				<h5 >List of Users</h5>
				
					<div class="row">
						<div class= "col-md-12">
							<div class="page-header">
								
									
									{{ Form::open(['route' => 'users.filtro','method' => 'GET','class' => 'form-inline pull-right'])}}
										
										<div class="form-group">
										{{ Form::text('name',null,['class' => 'form-control' , 'placeholder' => 'Name'])}}
										</div>
										<div class="form-group">
										{{ Form::text('email',null,['class' => 'form-control' , 'placeholder' => 'Email'])}}
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-secondary">
												<span class="oi oi-magnifying-glass"></span>
											</button>
										</div>
									{{ Form::close() }}
								
							</div>
						</div>
					</div>
				
				
				</div>

				<div class="card-body">

					<div id="posts" class="row pl-5">

						@include('users.userList', ['users'=>$users])

					</div>

				</div>

			</div>

		</div>
{{ $users->render() }}
	</div>

</div>

@endsection