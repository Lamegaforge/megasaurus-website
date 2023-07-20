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
            <p class="text-white">Liste des clips</p>
            @foreach ($clips as $clip)
            <div class="relative text-white">
                <img src="{{ $clip->thumbnail() }}" alt="">
                <div>
                    <p>Par {{ $clip->author->name }}</p>
                    <p>{{ $clip->game->name }}</p>
                </div>
                <p class="absolute top-1 left-1 z-10 text-white">{{ $clip->duration }}</p>
                <p class="absolute top-1 right-1 z-10 text-white">{{ $clip->views }} vues</p>
            </div>
            @endforeach
            {{ $clips->links('pagination::tailwind') }}
        </section>
    </main>
    <x-footer></x-footer>
</body>

</html>