<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/css/app.min.css"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- JonyGuan 自定义可重用方法集合 scripts -->
    <script src="/assets/backhome/scripts/jonyguan.js"></script>
    <style>
        .content{
            margin-top: 50px;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container" id="layout">
        @include('layouts.nav')
        <div class="content">
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
