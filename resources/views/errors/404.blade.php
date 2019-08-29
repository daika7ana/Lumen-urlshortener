@extends('layouts.app')


@section('header') 

@endsection


@section('content')

    <div id="initForm">

        <img src="/images/shorten.png" class="mb-4 img-fluid">
		<h1 class="mb-0">Oops!</h1>
		<h2 class="mb-4">Something's wrong here...</h2>
		<h4>Warping you back to the homepage in <span id="countdown">5</span>!</h4>
		
    </div>

@endsection


@section('footer-plugins')  

@endsection


@section('footer-scripts')

	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', event => {
			let el = document.getElementById("countdown"),
				timeleft = el.innerHTML,
				redirectTimer = setInterval(function() {
					timeleft--;
					el.innerHTML = timeleft;
					timeleft <= 0 && (location.href = window.location.origin);
			}, 1000);
		});
	</script>

@endsection