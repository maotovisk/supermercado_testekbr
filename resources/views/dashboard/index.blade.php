@section('title', 'Painel de Controle')
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Painel de controle') }}</p>
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <br>
                        @if (Auth::user()->is_admin)
                            Olá administrador, para começar a navegar, utilize das abas acima!
                        @else
                            Olá usuário, para começar a navegar, utilize das abas acima!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
