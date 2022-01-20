<!DOCTYPE html>
<html class="flex flex-col min-h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="{{ mix('/js/app.js') }}"></script>

        <title>Wordle</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Pacifico:wght@400;600;700&display=swap" rel="stylesheet">

        {{-- @font-face {
            font-family: Pacifico-Regular;
            src: url('{{ public_path('fonts/Pacifico/Pacifico-Regular.tff') }}');
        } --}}
        <style>
            body {
                {{-- background: url('/images/background-image.jpg') no-repeat fixed;
                background-size: 100% 100%; --}}
            }
            .title {
                font-family: Pacifico;
            }
        </style>
    </head>
    <body class="flex-1 bg-black">
        <img class="h-full w-full absolute top-0 right-0 bottom-0 left-0 object-cover opacity-30"
             src="/images/background-image.jpg" alt="" style="z-index: -1;">
        <div id="app" class="h-full min-h-full mx-auto">
            @include('partials.userbar')
            <div class="mt-10 @if (! isset($player)) pt-16 @endif">
                @yield('content')
            </div>
        </div>

    </body>
</html>