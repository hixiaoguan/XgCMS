<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Page title -->
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @include('backhomes.includes.style')
    @yield('style')
</head>
<body class="blank fixed-sidebar fixed-navbar fixed-footer">

<!--[if lt IE 7]>
<p class="alert alert-danger">你的浏览器 <strong>太老了</strong> ！！ 请 <a href="http://browsehappy.com/">升级</a> 你的浏览器。</p>
<![endif]-->

@include('backhomes.includes.header')

@include('backhomes.includes.aside')

@yield('content')

@include('backhomes.includes.script')

@yield('script')

</body>
</html>
