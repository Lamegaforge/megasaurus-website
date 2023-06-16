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
    <section class="relative flex items-center h-[600px] mb-6">
        <x-featured-clip :featuredClip="$featuredClip">
        </x-featured-clip>
    </section>

    <section class="container mx-auto mb-6">
        <x-slider title="Clips récents" sliderSelector="js-latest-clips-slider" :items="$latestAvailableClips">
        </x-slider>
    </section>

    <section class="container mx-auto mb-6">
        <x-slider title="Nouveaux jeux" sliderSelector="js-latest-games-slider" :isGame="true" :items="$latestGames">
        </x-slider>
    </section>

    <section class="container mx-auto mb-6">
        <x-slider title="Jeux populaires" sliderSelector="js-popular-games-slider" :isGame="true" :items="$popularGames">
        </x-slider>
    </section>
</body>

</html>