@php
$title = app()->view->getSections()['title'];
$menu = app()->view->getSections()['menu'];
$submenu = app()->view->getSections()['submenu'];
$type = app()->view->getSections()['type'];

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @livewireStyles
    @livewireScripts
</head>

<body>
    <div class="menu">
        <a href="/">Home</a>
        &nbsp;&nbsp;
        <a href="/criterios/list">Critérios</a>
        &nbsp;&nbsp;
        <a href="/alternativas/list">Alternativas</a>
    </div>

    @yield('content')
</body>

</html>
