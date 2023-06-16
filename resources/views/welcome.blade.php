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
    <x-nav />

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