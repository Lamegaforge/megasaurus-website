@extends('layouts.common')

@section('title', 'MEGASAURUS')

@section('javascript')
    @vite('resources/js/slider.js')
@endsection

@section('main')
<main class="mt-[84px] lg:mt-[68px] mb-10">
    <section class="relative flex items-center h-[600px] mb-6">
        <x-featured-clip :featuredClip="$featuredClip">
        </x-featured-clip>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <x-clip-slider title="Clips récents" sliderSelector="js-latest-clips-slider" :items="$latestAvailableClips">
        </x-clip-slider>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <x-game-slider title="Nouveaux jeux" sliderSelector="js-latest-games-slider" :items="$latestGames">
        </x-game-slider>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <x-game-slider title="Jeux populaires" sliderSelector="js-popular-games-slider" :items="$popularGames">
        </x-game-slider>
    </section>
</main>
@endsection