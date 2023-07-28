@inject('cdnService', \App\Services\CdnService::class)
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
            
            <div class="flex flex-col items-center mb-6 lg:flex-row lg:justify-end lg:mb-4">
                <div class="relative inline-flex items-center mb-4 text-white lg:mb-0 lg:mr-4">
                    <svg
                        class="absolute top-1/2 left-3 w-5 h-5 -translate-y-1/2"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd">
                        </path>
                    </svg>
                    <form method="GET" action="/clips">
                        <input 
                            class="py-2 pr-2 pl-[42px] bg-zinc-700 rounded-lg placeholder:text-white outline-offset-0 focus:outline-none focus-visible:outline-1 focus-visible:outline-orange-500" 
                            type="search" 
                            name="query"
                            value="{{ request()->get('query') }}" 
                            placeholder="Rechercher un jeu" 
                            maxlength="255" 
                        />
                    </form>
                </div>
                @unless(request()->filled('query'))
                <div class="relative">
                    <button class="js-filters-btn flex items-center p-2 text-white bg-zinc-700 rounded-lg focus:outline focus:outline-1 focus:outline-orange-500" type="button">
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4">
                            </path>
                        </svg>
                        <span class="text-white">Trier par</span>
                    </button>
                    <div class="js-filters-list filters-list absolute left-1/2 w-max -translate-x-1/2 z-20">
                        <div class="overflow-hidden">
                            <ul class="mt-1 p-2 bg-zinc-700 rounded-lg lg:mt-2">
                                <li class="mb-3">
                                    <button
                                        data-filter="views"
                                        type="button"
                                        class="js-selected flex items-center text-white lg:hover:text-orange-500 focus:text-orange-500 transition-colors ease-in-out duration-200
                                    ">
                                        <span>Nombre de vues</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        data-filter="dates"
                                        type="button"
                                        class="js-dates flex items-center text-white lg:hover:text-orange-500 focus:text-orange-500 transition-colors ease-in-out duration-200
                                    ">
                                        <span>Dates</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="grid grid-cols-1 px-4 sm:grid-cols-2 sm:gap-x-4 sm:gap-y-8 sm:px-0 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($clips as $clip)
                <div class="relative">
                    <a href="">
                        <img class="w-full rounded transition-transform duration-300 hover:scale-105" src="{{ $cdnService->thumbnail($clip->uuid) }}" alt="">
                        <div class="mt-3">
                            <p class="text-slate-300">{{ $clip->title }}</p>
                            <p class="text-white">{{ $clip->game->name }}</p>
                        </div>
                    </a>
                    <p class="absolute top-2 left-2 z-10 text-white">
                        <span class="block bg-slate-700/80 px-2 py-1 rounded-sm">{{ $clip->duration }} secondes</span>
                    </p>
                    <p class="absolute top-2 right-2 z-10 text-white">
                        <span class="block bg-slate-700/80 px-2 py-1 rounded-sm">{{ $clip->views }} vues</span>
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