@extends('layouts.app')

@section('stylesheets')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
}

.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}

.title {
    font-size: 84px;
}

.links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
}

.m-b-md {
    margin-bottom: 30px;
}
</style>

@endsection

@section('content')

<div class="content">

    <div class="title m-b-md">
        {{ config('app.name') }}
    </div>

    <div class="links">
        <a href="https://laravel.com/docs" target="_blank">Documentation</a>
        <a href="https://laracasts.com" target="_blank">Laracasts</a>
        <a href="https://laravel-news.com" target="_blank">News</a>
        <a href="https://nova.laravel.com" target="_blank">Nova</a>
        <a href="https://forge.laravel.com" target="_blank">Forge</a>
        <a href="https://github.com/laravel/laravel" target="_blank">GitHub</a>
    </div>
</div>

@endsection
