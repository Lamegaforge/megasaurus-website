<h2 class="mb-4 pl-4 text-2xl lg:mb-5 lg:pl-0 lg:text-3xl">{{ $title }}</h2>
<div class="splide {{ $sliderSelector }}">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($items as $item)
            <li class="splide__slide !mr-4">
                <a href="{{ route('clips.show', $item->uuid) }}">
                    {{-- <img src="{{ $item->thumbnail() }}" alt=""> --}}
                    <img src="https://ad-vitam.fra1.cdn.digitaloceanspaces.com/megasaurus-dev/thumbnails/AliveDistinctGooseBCouch" alt="">
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>