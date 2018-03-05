@extends('layouts.app')


@section('header') 

    <link href="/css/custom.css" rel="stylesheet">  

@endsection


@section('content')

    <div class="url-form">
		<h1>Invalid URL</h1>
		<h4>Redirecting back to main website in <br /> <span id="countdown">5</span> seconds</h4>
    </div>

@endsection


@section('footer-plugins')  

@endsection


@section('footer-scripts')

	<script type="text/javascript">
		$(document).ready(function () {
		    var timeleft = $('#countdown').text();
		    var downloadTimer = setInterval(function(){
			    timeleft--;
			    $('#countdown').text(timeleft);
			    if(timeleft <= 0){
			        location.href = window.location.origin;
			    }
		    },1000);

		});
	</script>

@endsection