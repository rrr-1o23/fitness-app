<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? env('APP_NAME') }}</title>
        @vite('resources/css/app.css')

        @isset($earlyAssetLoad)
            {!! $earlyAssetLoad !!}
        @endisset
    </head>
    
    <body class="bg-gray-50 text-gray-800 h-screen flex flex-col">

    @include('layouts.front.nav')

    <main class="container mx-auto p-8 max-w-4xl h-auto grow">
        {{ $slot }}
    </main>

    @include('layouts.front.footer')

    @isset($js)
        <script>
            {{$js}}
        </script>
    @endisset

    @vite('resources/js/app.js')

    @isset($lateAssetLoad)
        {!! $lateAssetLoad !!}
    @endisset
    </body>
</html>