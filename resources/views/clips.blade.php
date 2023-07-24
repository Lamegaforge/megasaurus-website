<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')

    <title>Liste des clips</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="h-full antialiased">
    <x-nav />
    <main class="mt-[84px] lg:mt-[68px] mb-10">
        <section class="container mx-auto mt-8 lg:px-10">
            <h2 class="mb-4 pl-4 text-2xl text-white lg:mb-5 lg:pl-0 lg:text-3xl">Tous les clips</h2>
            
            <div class="grid grid-cols-1 px-4 sm:grid-cols-2 sm:gap-x-4 sm:gap-y-8 sm:px-0 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($clips as $clip)
                    <div class="relative">
                        <img class="w-full rounded transition-transform duration-300 hover:scale-105" src="{{ $clip->thumbnail() }}" alt="">
                        <div class="mt-3">
                            <p class="text-white">Par {{ $clip->author->name }}</p>
                            <p class="text-white">{{ $clip->game->name }}</p>
                        </div>
                        <p class="absolute top-2 left-2 z-10 text-white">
                            <span class="block bg-slate-300/50 px-2 py-1 rounded-sm">{{ $clip->duration }}</span>
                        </p>
                        <p class="absolute top-2 right-2 z-10 text-white">
                            <span class="block bg-slate-300/50 px-2 py-1 rounded-sm">{{ $clip->views }} vues</span>
                        </p>
                    </div>
                @endforeach
            </div>

            {{ $clips->links('pagination::tailwind') }}
        </section>
    </main>
    <x-footer />
</body>

</html>