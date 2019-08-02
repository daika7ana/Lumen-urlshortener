@extends('layouts.app')

@section('header') 

    <link rel="preload" href="/css/custom.min.css?v=1.0.0" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="/css/custom.min.css?v=1.0.0"> <!-- Thank you Firefox -->

@endsection

@section('content')

    <form class="url-form">
        <img src="/images/shorten.png" class="mb-4 img-fluid">

        <label for="url" class="sr-only">What URL do you want shortened?</label>
        <input id="url" type="url" name="url" class="form-control mb-3" placeholder="What URL do you want shortened?" required autocomplete="off">
        <div id="ajax-response" style="display: none;" class="mb-4"></div>
        
        <button id="formSubmit" type="submit" class="btn btn-lg btn-dark btn-block">Go for it!</button>
    </form>

    <div class="additionalInfo">
        Open Source Project repository found on <a href="https://github.com/daika7ana/lumen-urlshortener" target="_blank"> GitHub</a>.
    </div>

@endsection

@section('footer-plugins')  

	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js" integrity="sha256-FiZwavyI2V6+EXO1U+xzLG3IKldpiTFf3153ea9zikQ=" crossorigin="anonymous" defer></script>

@endsection

@section('footer-scripts')

	<script type="text/javascript" src="/js/custom.min.js?v=1.0.1" defer></script>

@endsection