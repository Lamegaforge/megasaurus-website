<h2 class="mb-4 pl-4 text-2xl text-white lg:mb-5 lg:pl-0 lg:text-3xl">{{ $title }}</h2>
<div class="splide {{ $sliderSelector }}">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($items as $item)
            <li class="splide__slide">
                <a
                    href="{{ route('games.show', $item->uuid) }}"
                    class="block group focus-visible:border-2 focus-visible:border-indigo-400 focus:outline-none"
                >
                    <img
                        class="transition duration-200 ease-in-out transform group-hover:scale-105"
                        loading="lazy"
                        src="{{ $item->card() }}"
                        alt=""
                    >
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>