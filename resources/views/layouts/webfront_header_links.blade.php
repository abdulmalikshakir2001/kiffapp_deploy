
<!--
This theme has been used from : https://colorlib.com
 -->
<head>
    <title>
        @if(View::hasSection('title'))
        @yield('title')
        @else
        Zaratica
        @endif
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Zaratica ERP | A Single Platform for all your business needs">
    <meta name="keywords" content="Zaratica, ERP, Online Accounting, Acconting, Inventory, E-Commerce, Online store, online shopping">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
    <!-- links  -->
    
    <!-- links  -->


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('webfront/t1/css/themify-icons.css')}}">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{asset('webfront/t1/css/owl.carousel.min.css')}}">
    <!-- Main css -->
    <link href="{{asset('webfront/t1/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dashboard_assets/WebFront/landing_page/css/landing_page.css')}}">
</head>
