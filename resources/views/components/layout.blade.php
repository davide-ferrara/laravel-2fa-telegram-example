<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 2FA</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
<header class="bg-white dark:bg-gray-800 shadow-md">
    <div class="container mx-auto flex h-16 max-w-screen-xl items-center justify-between px-6">
        <a class="text-sky-500 dark:text-sky-400 font-bold text-lg" href="/">
            Laravel 2FA
        </a>
        <nav aria-label="Global" class="hidden md:flex items-center gap-6 text-sm font-medium">
        </nav>
        <div class="flex items-center gap-4">
            @guest
                <div class="flex gap-4">
                    <x-a-btn href="/login">Login</x-a-btn>
                    <x-a-btn-dark href="/register">Register</x-a-btn-dark>
                </div>
            @endguest
            @auth
                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold">Hello, {{ Auth::user()->first_name }}!</span>
                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded-md text-white font-medium transition">Log Out</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>
<main class="container mx-auto">
    {{ $slot }}
</main>
</body>
</html>
