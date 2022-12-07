@extends('layouts.app')

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

@section('footer-scripts')

    <script type="text/javascript" src="{{ url('js/manifest.js?v=1.2') }}" defer></script>
    <script type="text/javascript" src="{{ url('js/vendor.js?v=1.2') }}" defer></script>
    <script type="text/javascript" src="{{ url('js/app.js?v=1.2') }}" defer></script>

@endsection
