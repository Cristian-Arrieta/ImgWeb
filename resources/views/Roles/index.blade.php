@extends('layouts.app')

@section('content')


@if(($roles != null) && (count($roles)> 9))
<div class="container">
@else
<div class="container full-height">	
@endif

	<div class="row justify-content-center">

		<div class="col-md-10">

			<div class="card">

				<div class="card-header d-flex justify-content-between align-items-end mb-2">List of Roles
				<div class="row">
					<div class= "col-md-12">
						<div class="page-header">
							
								
								{{ Form::open(['route' => 'roles.filtro','method' => 'GET','class' => 'form-inline pull-right'])}}
									
									<div class="form-group">
									{{ Form::text('name',null,['class' => 'form-control' , 'placeholder' => 'Name'])}}
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
				
					@can('roles.create')
					<a href="{{route('roles.create')}}" class="btn btn-primary">Create Role</a>
					@endcan
				
				</div>

				<div class="card-body">

					

						<table class="table table-striped table-hover">
						
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Role</th>
								<th colspan=3>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($roles as $role)
								<tr>
									<td>{{$role->id}}</td>
									<td>{{$role->name}}</td>
									<td width="10px">
										@can ('roles.index')										
											<a href="{{ route('roles.show',$role->slug) }}" 
											class="btn btn-sm btn-outline-info"><span class="oi oi-eye"> Show</a>
										@endcan
									</td>
									<td width="10px">
										@can ('roles.edit')
											<a href="{{ route('roles.edit',$role->slug) }}"
											class="btn btn-sm btn-outline-secondary"> <span class="oi oi-pencil">   Edit</a>
										@endcan
									</td>
									<td width="10px">
										@can ('roles.destroy')
											{!!Form::open(['route' => ['roles.destroy',$role->slug],
											'method' => 'DELETE'])!!}
												<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?')">
												<span class="oi oi-trash">	Delete
												</button>
											{!!Form::close()!!}	
										@endcan
									</td>
								</tr>
							@endforeach	
						</tbody>
					</table>

					

				</div>

			</div>

		</div>
{{ $roles->render() }}
	</div>

</div>

@endsection

