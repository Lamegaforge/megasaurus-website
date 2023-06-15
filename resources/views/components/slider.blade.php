@inject('cdnService', 'App\Services\CdnService')

<h2 class="text-2xl">{{ $title }}</h2>
<div class="splide {{ $sliderSelector }}">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($games as $game)
                <li class="splide__slide !mr-4">
                    <img src="{{ isset($isGame) ? $cdnService->card($game) : $cdnService->thumbnail($game) }}" alt="">
                </li>
            @endforeach
        </ul>
    </div>
</div>