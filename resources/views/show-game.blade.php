@extends('layouts.common')

@section('title', 'Games | Megasaurus')

@section('main')
<main class="mt-[84px] lg:mt-[68px] mb-10">
    {{-- <x-featured-clip
        :featuredClip="$game"
        :infos="true"
    >
    </x-featured-clip> --}}
    <section class="relative flex items-center lg:h-[600px]">
        <div
            class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur"
            style="background-image: url('https://megasaurus.fra1.cdn.digitaloceanspaces.com//dev/thumbnails/7430b669-07d7-4c71-843b-60d78f1d9de2')
        "></div>
        <div class="absolute top-0 bottom-0 w-full bg-[rgba(14,16,21,0.5)]"></div>
        <div class="relative px-4">
            <img loading="lazy" class="rounded" src="{{ $game->card() }}" alt="">
            <p class="text-white">{{ $game->name }}</p>
            <p class="text-white">{{ $game->clips_count }} clips</p>
        </div>
    </section>
    <section class="container mx-auto mt-8 lg:px-10">
        <h2 class="mb-4 pl-4 text-2xl text-white lg:mb-5 lg:pl-0 lg:text-3xl">Tous les clips</h2>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <h2 class="mb-4 pl-4 text-2xl text-white lg:mb-5 lg:pl-0 lg:text-3xl">Les meilleurs clips</h2>
    </section>
</main>
@endsection