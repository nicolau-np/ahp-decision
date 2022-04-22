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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @livewireStyles
    @livewireScripts
</head>

<body>
    <div class="menu">
        <a href="/">Home</a>
        &nbsp;&nbsp;
        <a href="/criterios/list">Critérios</a>
        &nbsp;&nbsp;
        <a href="/alternativas/list">Projectos</a>
        &nbsp;&nbsp;
        <a href="/resultados">Resultados</a>
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>
