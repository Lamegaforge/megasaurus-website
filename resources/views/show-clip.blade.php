@inject('cdnService', 'App\Services\CdnService')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')

    <title>Clip</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="h-full antialiased">
    <x-nav />

    <section class="relative flex items-center h-[600px] mb-6">
        <x-featured-clip
            :featuredClip="$clip"
        ></x-featured-clip>
    </section>

    <pre>
        {{ print_r($clip) }}
    </pre>

    <x-footer></x-footer>
</body>
</html>