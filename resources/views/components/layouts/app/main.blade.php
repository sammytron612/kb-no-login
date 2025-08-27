<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased overflow-x-hidden">
    <div class="min-h-screen bg-gray-100 dark:bg-zinc-900">
        <x-layouts.app.sidebar />
        <main>
            {{ $slot }}
        </main>
    </div>
    @fluxScripts
</body>
</html>
