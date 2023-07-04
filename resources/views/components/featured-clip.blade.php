@php
    $hasClipInfos = isset($infos) && $infos !== "";
@endphp
<div class="absolute inset-x-0 inset-y-0 bg-no-repeat bg-cover blur-sm" style="background-image: url('{{ $featuredClip->thumbnail() }}')"></div>
<div
    class="w-[900px] max-w-full mx-auto px-5 lg:px-0 @if($hasClipInfos) wrapper-has-infos @endif">
    <div class="relative aspect-video">
        <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $iframeSrc() }}" allowfullscreen></iframe>
</div>
@if($hasClipInfos)
    <div class="relative text-white lg:self-center">
         {{-- <pre>
            {{ print_r($featuredClip) }}
         </pre> --}}
         <h2>{{ $featuredClip->title }}<h2>
         <p>par {{ $featuredClip->author->name }}</p>
         <p>{{ $featuredClip->views }} vues</p>
    </div>
@endif
</div>