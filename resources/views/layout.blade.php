<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Book App Project')</title>
    <link href="/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
@include('include.header')
@yield('content')
<script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>
