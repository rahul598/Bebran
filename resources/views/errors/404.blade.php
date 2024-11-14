@extends('layouts.app')


@section('content')

<!-- post section start from here -->
<div class="forederofore_area" style=" background-image: url({{ asset('frontend/images/be-bran-404bg.jpg') }});">
	<div class="container">
	  <div class="forederoforetextbox">
		<h1>404</h1>
		<h4>oops!  Page Not Fond</h4>
		<p>We are really sorry, but the page you requested was not found.</p>
		<p>It seems that the page you were trying to reach does not exist anymore or maybe it has just been moved. If you're looking for something try using the search form the top or just click on the image to go to the homepage.</p>
  
		<div class="btn_area mt-5 justify-content-center d-flex align-items-center">
		  <a href="{{ url('/') }}" class="btn btn-primary">Back To Home</a>
		  <a href="{{ url('contact-us') }}" class="btn btn-outline-primary">Contact us</a>
		</div>
	  </div>
	  <div class="forederoimg">
		<img src="{{ asset('frontend/images/be-bran-404main.webp') }}" alt="404">
	  </div>
	</div>
  </div>

@endsection
