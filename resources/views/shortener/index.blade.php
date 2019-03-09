@extends('layouts.app')


@section('header') 

    <link rel="stylesheet" href="/css/custom.css">  

@endsection


@section('content')

    <form class="url-form">
	  <img src="/images/shorten.png" class="mb-3 img-fluid">
      <label for="url" class="sr-only">What URL do you want shortened?</label>
      <input type="url" id="url" name="url" class="form-control mb-3" placeholder="What URL do you want shortened?" required autofocus>
      <div style="display: none;" class="ajax-response mb-4"></div>
      <button class="btn btn-lg btn-dark submitBtn" type="submit">Go for it!</button>
    </form>

@endsection


@section('footer-plugins')  

	<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.4/dist/clipboard.min.js"></script>

@endsection


@section('footer-scripts')

	<script type="text/javascript" src="/js/custom.js"></script>

@endsection