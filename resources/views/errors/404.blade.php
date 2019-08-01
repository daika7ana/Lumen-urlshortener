@extends('layouts.app')


@section('header') 

    <link href="/css/custom.min.css" rel="stylesheet">  

@endsection


@section('content')

    <div class="url-form">
        <img src="/images/shorten.png" class="mb-4 img-fluid">
		<h1 class="mb-0">Oops!</h1>
		<h2 class="mb-4">Something's wrong here...</h2>
		<h4>Redirecting back to main website in <br /> <span id="countdown">5</span> seconds.</h4>
    </div>

@endsection


@section('footer-plugins')  

@endsection


@section('footer-scripts')

	<script type="text/javascript">
		jQuery(function($) {
		    let timeleft = $('#countdown').text(),
		    	redirectTimer = setInterval(function() {
					timeleft--;
					$('#countdown').text(timeleft);
					if(timeleft <= 0) 
						location.href = window.location.origin;
		    }, 1000);
		});
	</script>

@endsection