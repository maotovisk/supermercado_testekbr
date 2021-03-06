<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Painel de Controle</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Entrar</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registrar</a>
                    @endif
                @endauth
            </div>
        @endif

        <x-application-logo />
            <x-container-principal>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Bem vindo ao sistema de supermercado!
                </h2>
                <hr>
                <br>
                @auth
                    Acesse o <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">painel</a>
                    para
                    continuar!</a>
                    <br>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Faça login</a> para
                    continuar!
                @endauth
            </x-container-principal>
    </div>
</body>

</html>
