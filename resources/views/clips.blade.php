@extends('layouts.common')

@section('title', 'Clips | Megasaurus')

@section('javascript')
    @vite('resources/js/slider.js')
    @vite('resources/js/filters.js')
@endsection

@section('main')
<main class="mt-[84px] lg:mt-[68px] mb-10">
    <section class="container mx-auto mt-8 lg:px-10">
        <div class="lg:flex lg:items-center lg:justify-between lg:mb-6">
            <h2 class="mb-4 pl-4 text-2xl text-white lg:mb-0 lg:pl-0 lg:text-3xl">Tous les clips</h2>
            <div class="flex flex-col items-center mb-6 lg:flex-row lg:justify-end lg:mb-0">
                <div class="relative inline-flex items-center h-10 mb-4 text-white lg:mb-0 lg:mr-4">
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
                    <form method="GET" action="{{ route('clips.index') }}">
                        <input
                            class="js-search-input search-input py-2 pr-2 pl-[42px] bg-zinc-700 rounded-lg placeholder:text-white outline-offset-0 focus:outline-none focus-visible:outline-2 focus-visible:outline-indigo-400"
                            type="search"
                            name="query"
                            value="{{ request()->get('query') }}"
                            placeholder="Rechercher un clip"
                            maxlength="255"
                        />
                    </form>
                    <button type="button" class="js-reset-search hidden absolute top-1/2 right-3 -translate-y-1/2">
                        <span class="text-2xl leading-none">&times;</span>
                    </button>
                </div>
                @unless(request()->filled('query'))
                @php
                    $page = "clips";
                    $filters = array(
                        "views" => array(
                            "type" => "views",
                            "text" => "Nombre de vues",
                        ),
                        "published_at" => array(
                            "type" => "published_at",
                            "text" => "Dates",
                        ),
                    );
                @endphp
                <x-filters :filters="$filters" :page="$page" />
                @endif
            </div>
        </div>

        @if($clips->isEmpty())
        <div class="py-16 text-center">
            <p class="text-white">Aucun résultat 🦕</p>
        </div>
        @else
        <div class="grid grid-cols-1 px-4 sm:grid-cols-2 sm:gap-x-4 sm:gap-y-8 sm:px-0 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($clips as $clip)
            <div class="relative">
                <a href="{{ route('clips.show', $clip->uuid) }}" class="block rounded group outline-offset-0 focus:outline-none focus-visible:outline-2 focus-visible:outline-indigo-400">
                    <div class="relative transition duration-200 ease-in-out transform shadow-md pt-16/9 group-hover:scale-105">
                        <img loading="lazy" class="rounded" src="{{ $clip->thumbnail() }}">
                    </div>
                    <div class="mt-3 text-white">
                        <p class="transition duration-200 ease-in-out group-hover:text-indigo-400 group-focus:text-indigo-400">{{ $clip->title }}</p>
                        <p class="text-sm text-gray-300">{{ $clip->game->name }}</p>
                    </div>
                </a>
                <p class="absolute top-2 left-2 z-10 text-white">
                    <span class="block bg-slate-700/80 px-2 py-1 rounded-sm">{{ $clip->duration }} s</span>
                </p>
                <p class="absolute top-2 right-2 z-10 text-white">
                    <span class="block bg-slate-700/80 px-2 py-1 rounded-sm">{{ $clip->views }} vues</span>
                </p>
            </div>
            @endforeach
        </div>
        {{ $clips->appends([
            'sort' => request()->input('sort')
        ])->links('pagination::tailwind') }}
        @endif
    </section>
</main>
@endsection