@extends('layouts.app')
<style>
	.columnas{flex:0 0 16.6666666667%;max-width:16.6666666667%}
	
	@media only screen and (max-width: 950px)
	{
		.columnas{flex:0 0 25%;max-width:25%}
	}
</style>
@section('content')

<script src="{{ asset('js/custom.js') }}" defer></script>


<div class="container ">


<div class="row justify-content-center">

<div class="col-md-12">

<div class="card">


<div class="card-body">

<nav>

<div class="nav nav-tabs" id="nav-tab" role="tablist">

<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#followers" role="tab" aria-controls="nav-home" aria-selected="true"> Works <span class="badge badge-primary">{{count($images)}}</span></a>

<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#following" role="tab" aria-controls="nav-profile" aria-selected="false"> Users <span class="badge badge-primary">{{count($users)}}</span></a>

</div>

</nav>

<div class="tab-content " id="nav-tabContent">
@if(($images != null) && (count($images)> 9))
<div class="tab-pane fade show active " id="followers" role="tabpanel" aria-labelledby="nav-home-tab">
@else
<div class="tab-pane fade show active full-height" id="followers" role="tabpanel" aria-labelledby="nav-home-tab">
@endif


<div class="row pl-5">

@include('images.workList', ['images'])

</div>

</div>
@if(($users != null) && (count($users)> 9))
<div class="tab-pane fade " id="following" role="tabpanel" aria-labelledby="nav-profile-tab">
@else
<div class="tab-pane fade full-height" id="following" role="tabpanel" aria-labelledby="nav-profile-tab">
@endif

<div class="row pl-5">

@include('users.userList', ['users'])

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>



@endsection