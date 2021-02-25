@section('title', 'Categorias')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Adicionar Categoria') }}</p>
                <x-botao-link :href="route('categorias')">Voltar</x-botao-link>
            </div>
        </x-slot>

        <x-container-principal>
            <!-- Erros de validação -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('categorias.registrar') }}">

                <!-- Token do CSRF (para impedir alguem dar post no target desse form por fora da página) -->
                @csrf

                <!-- Nome -->
                <div>
                    <x-label for="tilulo" :value="__('Título')" />

                    <x-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo')" required
                        autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Adicionar') }}
                    </x-button>
                </div>
            </form>
        </x-container-principal>
    </x-app-layout>
