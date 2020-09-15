@extends('layouts.app')

@section('content')
<div class="container  full-height">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Role</div>

                <div class="card-body">
					<p><strong>Name : </strong>{{ $role->name }}</p>
					<p><strong>Description : </strong>{{ $role->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
