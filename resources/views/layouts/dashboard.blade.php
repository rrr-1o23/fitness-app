<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fitness Dashboard</title>
        @vite('resources/css/dashboard.css')

        @isset($earlyAssetLoad)
        {!! $earlyAssetLoad !!}
        @endisset
    </head>
    <body class="bg-gray-200 flex flex-col min-h-screen bg-secondary">

    @include('layouts.dashboard.nav')

    <main class="container mx-auto p-8 max-w-6xl h-auto grow">
        <!-- エラーメッセージ -->
        <div>
        @include('layouts.dashboard.messages')
        </div>
    {{ $slot }}
    </main>

    @include('layouts.dashboard.footer')

    @vite('resources/js/app.js')

    @isset($lateAssetLoad)
    {!! $lateAssetLoad !!}
    @endisset
    </body>
</html>