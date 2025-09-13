<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @livewireStyles
    @filamentStyles
  </head>
  <body class="bg-gray-100 dark:bg-gray-900">
    @yield('content')

    @livewireScripts
    @filamentScripts
  </body>
</html>
