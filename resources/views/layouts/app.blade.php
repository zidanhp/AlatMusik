<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Insphony</title>
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @vite(['resources/js/app.js'])
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>
<body class="bg-gray-50">
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main class="p-4 md:ml-64 mt-16">
        <div class="container mx-auto">
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
    <div id="app">
        <example-component></example-component>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>