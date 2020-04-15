@extends('layouts.app')

@section('content')
<div class="container  full-height">
    <div class="row justify-content-center">
       
            <div class="card">
               
				<img class="img-fluid rounded"src="{{asset('img/error-404.jpg')}} "  />
                <a href="{{route('home')}}" class="btn btn btn-outline-primary btn-lg btn-lg btn-block" style="margin: 1rem auto;"><h2><span class="oi oi-home"></span> Return Home <span class="oi oi-home"></span></h2></a>
            </div>
       
    </div>
</div>
@endsection
