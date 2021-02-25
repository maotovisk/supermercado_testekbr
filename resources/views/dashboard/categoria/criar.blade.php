@section('title', 'Categorias')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Adicionar Categoria') }}</p>
                <button onclick="window.location.href='{{ route('categorias') }}'"
                    class="bg-gray-400 hover:bg-gray-900 text-white text-xs px-6 py-2 rounded-lg border-0">Voltar</button>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <!-- Erros de validação -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('categorias.registrar') }}">
                            
                            <!-- Token do CSRF (para impedir alguem dar post no target desse form por fora da página) -->
                            @csrf

                            <!-- Nome -->
                            <div>
                                <x-label for="tilulo" :value="__('Título')" />

                                <x-input id="titulo" class="block mt-1 w-full" type="text" name="titlulo" :value="old('titulo')"
                                    required autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Adicionar') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
