<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Bellic Boxing') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="/images/logo.png">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased">
        <div class="relative min-h-screen dark:bg-gray-900 selection:bg-red-500 selection:text-white bg-contain bg-no-repeat"
            style="background-image: url(/images/home.png)">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="pt-7 h-16 text-right">
                    <span class="inline-flex items-center px-3 text-2xl pb-1   dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        Boxers
                    </span>
                    <span class="inline-flex items-center px-3 text-2xl pb-1   dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        Events
                    </span>
                    <span class="inline-flex items-center px-3 text-2xl pb-1   dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        Matchmaking
                    </span>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold inline-flex items-center px-3 text-2xl pb-1   dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="font-semibold inline-flex items-center px-3 text-2xl pb-1   dark:text-red-500 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Join Now</a>
                        <a href="{{ route('login') }}" class="bg-red-500 font-semibold inline-flex items-center px-3 text-2xl pb-1   dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Log in</a>
                    @endauth
                </div>
                <img src="/images/logo.png" class="h-20 fixed top-5 left-12" />
                <span class="fixed bottom-5 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl text-gray-300"> 
                    Bellic Boxing
                </span>
            </div>
        </div>
    </body>
</html>
