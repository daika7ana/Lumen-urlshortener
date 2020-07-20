<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Sqiz.me URL Shortener</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    
    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="preload" href="{{ url('css/app.css') }}?v=1.0.5" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ url('css/app.css') }}?v=1.0.5"> <!-- Thank you Firefox -->

    @yield('header')

</head>

<body class="text-center">

    @yield('content')

    @yield('footer-plugins')
   
    @yield('footer-scripts')

</body>

</html>