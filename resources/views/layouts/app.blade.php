<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Sqiz.me URL Shortener</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    
    <!-- Bootstrap Core Css -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preload" href="{{ url('css/app.css') }}?v=1.0.2" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ url('css/app.css') }}?v=1.0.2"> <!-- Thank you Firefox -->

    @yield('header')

</head>

<body class="text-center">

    @yield('content')

    @yield('footer-plugins')
   
    @yield('footer-scripts')

</body>

</html>