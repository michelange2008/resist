<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Resist</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">
    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <a href="{{ url('/accueil') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Accueil</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Connexion</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Enregistrement</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="flex flex-col gap-5 items-center p-6 mx-auto w-full lg:p-8 bg-slate-300">
            <div class="flex gap-3 justify-center mb-12">
                <img src="{{ url('storage/pict/resist.svg') }}" alt="resist">
                <img src="{{ url('storage/pict/HC_3.webp')}}" alt="Haemonchus contortus">
                <div class="flex flex-col gap-3 justify-around px-2 text-5xl font-bold text-amber-800">
                    <p>Observatoire</p>
                    <p>des</p>
                    <p>Résistances</p>
                    <p>aux</p>
                    <p>Anthelmintiques</p>
                    <p>dans la</p>
                    <p>Drôme</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam dolore adipisci possimus omnis perspiciatis! Recusandae, quis omnis quod quibusdam aliquid magnam vel saepe dignissimos, facere error suscipit nam animi? Quasi!</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam dolore adipisci possimus omnis perspiciatis! Recusandae, quis omnis quod quibusdam aliquid magnam vel saepe dignissimos, facere error suscipit nam animi? Quasi!</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam dolore adipisci possimus omnis perspiciatis! Recusandae, quis omnis quod quibusdam aliquid magnam vel saepe dignissimos, facere error suscipit nam animi? Quasi!</p>
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
