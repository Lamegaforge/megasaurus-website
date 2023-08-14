@extends('layouts.common')

@section('title', 'Games | Megasaurus')

@section('main')
<main class="mt-[84px] lg:mt-[68px] mb-10">
    {{-- <x-featured-clip
        :featuredClip="$game"
        :infos="true"
    >
    </x-featured-clip> --}}
    <section class="relative flex items-center lg:h-[400px]">
        <div
            class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur"
            style="background-image: url('{{ $gameThumbnail }}')
        "></div>
        <div class="absolute top-0 bottom-0 w-full bg-[rgba(14,16,21,0.5)]"></div>
        <div class="container mx-auto lg:relative lg:h-full">
            <div class="relative p-4 sm:flex sm:items-center sm:p-0 lg:absolute lg:top-1/4 lg:left-10">
                <img loading="lazy" class="rounded max-w-[256px] " src="{{ $game->card() }}" alt="">
                <div class="mt-4 sm:ml-8 sm:mt-0 lg:ml-16">
                    <h1 class="mb-1 text-4xl font-extrabold leading-10 text-white">{{ $game->name }}</h1>
                    <p class="font-semibold text-white ">{{ $game->clips_count }} clips</p>
                </div>
            </div>
        </div>
    </section>
    <section class="container mx-auto mt-8 lg:px-10 lg:mt-36">
        <x-clip-slider
            title="Tous les clips"
            sliderSelector="js-latest-clips-slider"
            :items="$popularGameClips"
        >
        </x-clip-slider>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <x-clip-slider
            title="Les meilleurs clips"
            sliderSelector="js-popular-games-slider"
            :items="$gameClips"
        >
        </x-game-slider>
    </section>
</main>
@endsection