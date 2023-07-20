<div class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur-sm" style="background-image: url('{{ $featuredClip->thumbnail() }}')"></div>
<div class="max-w-full mx-auto px-5 @if($infos) wrapper-has-infos w-[1100px] mb-4 lg:mb-0 xl:px-0 @else w-[900px] lg:px-0 @endif">
    <div class="relative aspect-video">
        <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $iframeSrc() }}" allowfullscreen></iframe>
    </div>
    @if($infos)
    <div class="relative mt-8 lg:self-center lg:mt-0">
        <h2 class="text-light-shadow mb-4 text-2xl text-white lg:mb-5 lg:text-3xl">{{ $featuredClip->title }}<h2>

        <p class="text-light-shadow text-white text-lg lg:text-xl">
            par {{ $featuredClip->author->name }}
        </p>
        <p class="mt-1 text-light-shadow text-white text-lg lg:text-xl">
            Publié il y a {{ $featuredClip->publishedAgo() }}
        </p>
        <p class="mt-1 text-light-shadow text-white text-lg lg:text-xl">{{ $featuredClip->views }} vues</p>
        <p class="mt-1 text-light-shadow text-white text-lg lg:text-xl">
            <a class="inline-block mt-3 text-light-shadow text-white hover:text-orange-500 focus:text-orange-500 text-lg lg:text-xl" href="{{ route('games.show', $featuredClip->game->uuid) }}">{{ $featuredClip->game->name }}</a>
        </p>
    </div>
    @endif
</div>