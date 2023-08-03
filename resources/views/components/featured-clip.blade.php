<div class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur" style="background-image: url('{{ $featuredClip->thumbnail() }}')"></div>
@if($infos)
    <div class="absolute top-0 bottom-0 w-full bg-[rgba(14,16,21,0.5)]"></div>
@endif
<div class="max-w-full mx-auto px-5 @if($infos) wrapper-has-infos w-[1100px] mb-4 lg:mb-0 xl:px-0 @else w-[900px] lg:px-0 @endif">
    <div class="relative aspect-video">
        <iframe loading="lazy" class="absolute top-0 left-0 w-full h-full" src="{{ $iframeSrc() }}" allowfullscreen></iframe>
    </div>
    @if($infos)
    <div class="relative mt-8 lg:self-center lg:mt-0">
        <h1 class="text-4xl font-extrabold leading-10 text-white">{{ $featuredClip->title }}</h1>
        <a class="mt-1 font-semibold text-white hover:text-indigo-400 focus:text-indigo-400" href="{{ route('games.show', $featuredClip->game->uuid) }}">{{ $featuredClip->game->name }}</a>
        <p class="mt-5 text-sm text-gray-300">Par {{ $featuredClip->author->name }}</p>
        <p class="mt-1 text-sm text-gray-300">Publié il y a {{ $featuredClip->publishedAgo() }}</p>
        <p class="mt-1 text-sm text-gray-300">{{ $featuredClip->views }} vues</p>
    </div>
    @endif
</div>