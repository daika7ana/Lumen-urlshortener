@extends('layouts.app')

@section('header') 
    
@endsection

@section('content')

    <div id="initForm">

        <img src="/images/shorten.png" class="mb-4 img-fluid">

        <shorten-form>
            {{-- Vue Element --}}
        </shorten-form>

    </div>

    <div class="additionalInfo">
        Open Source Project repository found on <a href="https://github.com/daika7ana/lumen-urlshortener" target="_blank">GitHub</a>.
    </div>

@endsection

@section('footer-plugins')  

    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js" integrity="sha256-inc5kl9MA1hkeYUt+EC3BhlIgyp/2jDIyBLS6k3UxPI=" crossorigin="anonymous" defer></script>

@endsection

@section('footer-scripts')

	<script type="text/javascript" src="{{ url('js/app.js?v=1.0.7') }}" defer></script>

@endsection