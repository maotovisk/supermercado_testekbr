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
                        {{ Auth::user()->id }}
                        <br>
                        @if (Auth::user()->is_admin)
                            Bom dia caro administrador.
                        @else
                            Bom dia caro usuário padrão que nao pode fazer nada além de ver os campos KKKKK.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
