@extends('layouts.app')

@section('content')

    <div id="initForm">
        <img src="/images/shorten.png" class="mb-4 img-fluid w-100">
        <h1 class="mb-0">Oops!</h1>
        <h2 class="mb-4">Something's wrong here...</h2>
        <h4>Warping you back to the homepage in <span id="countdown">5</span>!</h4>
    </div>

@endsection

@section('footer-scripts')

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            let el = document.getElementById("countdown"),
                timeleft = el.innerHTML,
                redirectTimer = setInterval(() => {
                    el.innerHTML = --timeleft;
                    timeleft <= 0 && (location.href = window.location.origin);
                }, 1000);
        });
    </script>

@endsection
