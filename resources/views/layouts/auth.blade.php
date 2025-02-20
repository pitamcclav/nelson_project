<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Agrilink</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md">
        @yield('content')
    </div>
</div>
</body>
</html>
