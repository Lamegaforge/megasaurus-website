@extends('layouts.common')

@section('title', $clip->title . ' | Megasaurus')

@section('main')
<main class="mt-[84px] lg:mt-[68px] mb-10">
    <section class="relative flex items-center mb-6 lg:h-[600px]">
        <x-featured-clip
            :featuredClip="$clip"
            :infos="true"
        >
        </x-featured-clip>
    </section>

    <section class="container mx-auto mt-8 lg:px-10">
        <x-clip-slider 
            title="Autres clips" 
            sliderSelector="js-latest-clips-slider" 
            :items="$randomClips">
        </x-clip-slider>
    </section>
</main>
@endsection