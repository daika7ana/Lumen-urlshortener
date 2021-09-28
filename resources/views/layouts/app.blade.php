<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Sqiz.me URL Shortener</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">

    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preload" href="{{ url('css/app.css') }}?v=1.1" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ url('css/app.css') }}?v=1.1"> <!-- Thank you Firefox -->

    @yield('header')

</head>

<body class="text-center">

    @yield('content')

    @yield('footer-plugins')

    @yield('footer-scripts')

</body>

</html>
