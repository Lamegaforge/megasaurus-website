<h2 class="mb-4 pl-4 text-2xl text-white lg:mb-5 lg:pl-0 lg:text-3xl">{{ $title }}</h2>
<div class="splide {{ $sliderSelector }}">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($items as $item)
            <a href="{{ route('clips.show', $item->uuid) }}" class="splide__slide block rounded group">
                <div class="relative transition duration-200 ease-in-out transform shadow-md pt-16/9 group-hover:scale-105">
                    <img loading="lazy" class="rounded" src="{{ $item->thumbnail() }}">
                </div>
                <div class="mt-3 text-white">
                    <p class="transition duration-200 ease-in-out group-hover:text-indigo-400">{{ $item->title }}</p>
                    <p class="text-sm text-gray-300">{{ $item->game->name }}</p>
                </div>
            </a>
            @endforeach
        </ul>
    </div>
</div>