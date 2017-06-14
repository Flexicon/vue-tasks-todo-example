<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Vue Tasks') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div id="app" class="container">
    <h1>Simple tasks App <span class="small">with VueJs as front-end and back-end in Laravel</span></h1>
    <app></app>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>