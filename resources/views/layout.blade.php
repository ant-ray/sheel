<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titel')</title>
</head>

<body>
    <!---header--->
    <header>@include('header')</header>
    <!---content--->
    @yield('content')
    <!---footerの挿入--->
    <footer>@include('footer')</footer>
    <script src="{{ mix('js/good.js') }}"></script>
    <script src="{{ mix('js/usually.js') }}"></script>
</body>

</html>
