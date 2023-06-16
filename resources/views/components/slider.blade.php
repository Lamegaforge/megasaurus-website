<h2 class="text-2xl">{{ $title }}</h2>
<div class="splide {{ $sliderSelector }}">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($items as $item)
            <li class="splide__slide !mr-4">
                <img src="{{ isset($isGame) ? $item->card() : $item->thumbnail() }}" alt="">
            </li>
            @endforeach
        </ul>
    </div>
</div>