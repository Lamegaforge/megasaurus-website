@extends('layouts.common')

@section('title', 'Games | Megasaurus')

@section('javascript')
    @vite('resources/js/slider.js')
@endsection

@section('main')
<main class="mt-[84px] lg:mt-[68px] mb-10">
    <section class="relative flex items-center lg:h-[400px]">
        <div
            class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur"
            style="background-image: url('{{ $gameThumbnail }}')
        "></div>
        <div class="absolute top-0 bottom-0 w-full bg-[rgba(14,16,21,0.5)]"></div>
        <div class="container mx-auto lg:relative lg:h-full">
            <div class="relative p-4 sm:flex sm:items-center lg:absolute lg:top-1/4 lg:left-10 lg:p-0">
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
            title="Les meilleurs clips"
            sliderSelector="js-latest-clips-slider"
            :items="$popularGameClips"
        >
        </x-clip-slider>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <h2 class="mb-4 pl-4 text-2xl text-white lg:mb-5 lg:pl-0 lg:text-3xl">Tous les clips</h2>

        <div class="grid grid-cols-2 px-4 sm:grid-cols-4 sm:gap-x-4 sm:gap-y-8 lg:grid-cols-6">
            @foreach ($gameClips as $gameClip)
                <div class="relative">
                    <a href="{{ route('clips.show', $gameClip->uuid) }}" class="block rounded group">
                        <div class="relative transition duration-200 ease-in-out transform shadow-md pt-16/9 group-hover:scale-105">
                            <img loading="lazy" class="rounded" src="{{ $gameClip->thumbnail() }}" alt="">
                        </div>
                        <div class="mt-3 text-white">
                            <p class="transition duration-200 ease-in-out group-hover:text-indigo-400 group-focus:text-indigo-400">{{ $gameClip->title }}</p>
                            <p class="text-sm text-gray-300">{{ $gameClip->game->name }}</p>
                        </div>
                    </a>
                    <p class="absolute top-2 left-2 z-10 text-white">
                        <span class="block bg-slate-700/80 px-2 py-1 rounded-sm">{{ $gameClip->duration }} s</span>
                    </p>
                    <p class="absolute top-2 right-2 z-10 text-white">
                        <span class="block bg-slate-700/80 px-2 py-1 rounded-sm">{{ $gameClip->views }} vues</span>
                    </p>
                </div>
            @endforeach
        </div>

        {{ $gameClips->appends([
            'sort' => request()->input('sort')
        ])->links('pagination::tailwind') }}
    </section>
</main>
@endsection