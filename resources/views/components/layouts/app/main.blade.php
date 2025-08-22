<!-- filepath: c:\Users\Kevin\kb-new\resources\views\components\layouts\app\main.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <div class="flex min-h-screen">
            <!-- Include the sidebar (which has its own Alpine logic) -->
            @include('components.layouts.app.sidebar')

            <!-- Main Content with dynamic margin -->
            <main class="flex-1 ml-16 lg:ml-64 transition-all duration-200">
                {{ $slot }}
            </main>
        </div>
        @fluxScripts
    </body>
</html>
