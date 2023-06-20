<nav class="overflow-hidden bg-slate-800">
    <div class="container mx-auto lg:flex">
        <div class="flex justify-between items-center p-4 lg:block lg:justify-start lg:mr-4">
            <h1>
                <a href="#" class="logo-text uppercase text-neutral-50 text-3xl">megasaurus</a>
            </h1>
            <button type="button" class="js-mobile-btn relative burger w-[30px] h-[30px] mr-3 appearance-none lg:hidden">
                <span class="bar bar--1"></span>
                <span class="bar bar--2"></span>
                <span class="bar bar--3"></span>
                <span class="bar bar--4"></span>
            </button>
        </div>
        <div class="js-menu submenu pb-4 lg:pb-0">
            <ul class="overflow-hidden lg:flex lg:items-center">
                <li class="mb-2 lg:mr-3 lg:mb-0">
                    <a class="menu-link relative block px-4 py-2 text-xl text-neutral-50 active:bg-slate-500 lg:pl-0 lg:active:bg-transparent" href="{{ route('clips.index') }}">Clips</a>
                </li>
                <li class="mb-2 lg:mr-3 lg:mb-0">
                    <a class="menu-link relative block px-4 py-2 text-xl text-neutral-50 active:bg-slate-500 lg:pl-0 lg:active:bg-transparent" href="{{ route('games.index') }}">Jeux</a>
                </li>
                <li>
                    <a class="menu-link relative block px-4 py-2 text-xl text-neutral-50 active:bg-slate-500 lg:pl-0 lg:active:bg-transparent" href="{{ route('clips.random') }}">Aléatoire</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
