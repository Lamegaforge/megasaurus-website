<div class="relative">
    <button
        class="js-filters-btn flex items-center p-2 text-white bg-zinc-700 rounded-lg focus:outline focus:outline-1 focus:outline-indigo-400"
        type="button"
        data-selected-filter="{{ request()->input('sort') }}"
    >
        <svg
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4">
            </path>
        </svg>
        <span class="text-white">Trier par</span>
    </button>
    <div class="js-filters-list filters-list absolute left-1/2 w-max -translate-x-1/2 z-20">
        <div class="overflow-hidden">
            <ul class="mt-1 p-2 bg-zinc-700 rounded-lg lg:mt-2">
                @foreach ($filters as $filter)
                    <li class="mb-3">
                        <a
                            href="/{{ $page }}?sort={{ $filter["type"] }}"
                            data-filter="{{ $filter["type"] }}"
                            class="flex items-center text-white lg:hover:text-indigo-400 focus:text-indigo-400 transition-colors ease-in-out duration-200
                        ">
                            <span>{{ $filter["text"] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
