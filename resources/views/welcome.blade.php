@inject('cdnService', 'App\Services\CdnService')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="h-full antialiased">
        <nav class="p-4 lg:flex">
            <div class="flex justify-between lg:block lg:justify-start lg:mr-4">
                <h1>
                    <a href="#" class="uppercase text-slate-950 text-3xl">megasaurus</a>
                </h1>
                <button type="button" class="js-mobile-btn w-10 h-10 lg:hidden">
                    <span class="js-mobile-burger flex flex-col w-full h-full justify-between">
                        <span class="block h-0.5 bg-slate-950"></span>
                        <span class="block h-0.5 bg-slate-950"></span>
                        <span class="block h-0.5 bg-slate-950"></span>
                    </span>
                    <span class="js-mobile-cross text-xl hidden">
                        &times;
                    </span>
                </button>
            </div>
            <ul class="js-menu hidden flex flex-col lg:flex lg:flex-row lg:items-center">
                <li class="lg:mr-3"><a href="#">Clips</a></li>
                <li class="lg:mr-3"><a href="#">Jeux</a></li>
                <li><a href="#">Aléatoire</a></li>
            </ul>
        </nav>
        <section
            class="relative flex flex-col justify-center items-center h-[600px] mb-6"
        >
            <div
                class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur-sm"
                style="background-image: url('{{ $cdnService->thumbnail($featuredClip) }}')"
            ></div>
            <iframe
                class="blur-none"
                src="https://clips.twitch.tv/embed?clip=RelentlessProtectiveAntPunchTrees-lSuVYjOFUBDgjaDm&parent=localhost"
                height="<height>"
                width="<width>"
                allowfullscreen>
            </iframe>
        </section>

        <section class="mb-6">
            <h2 class="text-2xl">Clips récents</h2>
        </section>
        <section class="mb-6">
            <h2 class="text-2xl">Nouveaux jeux</h2>
        </section>
        <section class="mb-6">
            <h2 class="text-2xl">Jeux populaires</h2>
        </section>
    </body>
</html>
