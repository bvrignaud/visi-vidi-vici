<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Visi vidi vici') }}</title>

    <meta name="description" content="@lang('pages/main.meta.description')">

    @laravelPWA

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body class="font-sans antialiased">
@inertia
</body>
</html>
