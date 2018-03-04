@extends('layouts.app')


@section('header') 

    <link href="/css/custom.css" rel="stylesheet">  

@endsection


@section('content')

    <form class="url-form">
	  <img src="/images/shorten.png" class="mb-4" height="100px">
      <label for="url" class="sr-only">What URL do you want shortened?</label>
      <input type="text" id="url" name="url" class="form-control mb-3" placeholder="What do you want shortened?" required autofocus>
      <div style="display: none;" class="ajax-response mb-3"></div>
      <button class="btn btn-lg btn-dark submitBtn" type="submit">Shorten me!</button>
    </form>

@endsection


@section('footer-plugins')  

	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

@endsection


@section('footer-scripts')

	<script type="text/javascript">
		$('.url-form').on('submit', function(event){
			event.preventDefault();
			var form = $('.url-form');
			$.ajax({
	            type: "POST",
	            url: '/create_url', 
	            data: form.serialize(),
	            success: function(data) {
	                if(data !== 'Invalid URL'){
	                	$('.ajax-response').html('<h3 class="h3 mb-3 font-weight-normal">Your ShortURL is: </h3><div style="display:flex;"><input id="shorturl" class="form-control clipboardInput" readonly value="'+ data +'"><button class="btn btn-dark clipboardBtn" data-clipboard-text="'+ data +'">Copy</button></div>').show(350);
	                	new ClipboardJS('.clipboardBtn');
	                }
	                else {
						$('.ajax-response').html('<h3 class="h3 font-weight-normal">'+ data + '</h3>').show(350);
	                }
	            }
	        });
		});
	</script>

@endsection