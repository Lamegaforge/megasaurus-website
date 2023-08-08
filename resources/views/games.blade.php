<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')

    <title>Liste des jeux</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="h-full antialiased">
    <x-nav />
    <main class="mt-[84px] lg:mt-[68px] mb-10">
        <section class="container mx-auto mt-8 lg:px-10">
            <h2 class="mb-4 pl-4 text-2xl text-white lg:mb-6 lg:pl-0 lg:text-3xl">Tous les jeux</h2>

            <div class="grid grid-cols-2 gap-4 px-4 sm:grid-cols-3 sm:gap-y-8 lg:grid-cols-4 lg:px-0 xl:grid-cols-6 xl:gap-x-8">
                @foreach ($games as $game)
                    <a href="{{ route('games.show', $game->uuid) }}" class="block group">
                        <img loading="lazy" class="rounded transition duration-200 ease-in-out transform group-hover:scale-105 group-focus:scale-105" src="{{ $game->card() }}" alt="">
                        <p class="mt-3 transition duration-200 ease-in-out text-white group-hover:text-indigo-400 group-focus:text-indigo-400">
                            {{ $game->name }}
                        </p>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
    <x-footer />
</body>

</html>