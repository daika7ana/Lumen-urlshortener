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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js" integrity="sha256-FiZwavyI2V6+EXO1U+xzLG3IKldpiTFf3153ea9zikQ=" crossorigin="anonymous" defer></script>

@endsection

@section('footer-scripts')

	<script type="text/javascript" src="{{ url('js/app.js?v=1.0.4') }}" defer></script>

@endsection