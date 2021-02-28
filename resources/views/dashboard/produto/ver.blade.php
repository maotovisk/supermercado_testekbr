@section('title', 'Adicionar Produto')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Adicionar Produto') }}</p>
                <div>
                    @if (Auth::user()->is_admin)
                        <x-botao-link :href="route('produtos.editar', $produto->id)">Editar</x-botao-link>
                    @endif
                    <x-botao-link :href="route('produtos')">Voltar</x-botao-link>

                </div>
            </div>
        </x-slot>

        <x-container-principal>
            <div class="flex flex-wrap justify-beetween">

                <div class="">
                    <img width="640" height="480" src="{{ $produto->imagem }}" alt="{{ $produto->titulo }}">
                </div>
                <div class="flex-grow ml-3 pt-4">

                    <p class="text-xl text-gray-800 font-semibold">{{ $produto->titulo }}</p><br>
                    <small> {{ $selectedCategory->titulo }} > {{ $selectedSubcategory->titulo }}</small>

                    <h2> R$ {{ $produto->valor }}</h2>

                    <span
                        class="bg-indigo-200 text-indigo-500 text-xs font-semibold rounded-md py-1 px-2">{{ $produto->is_active ? 'Ativo' : 'Inativo' }}</span>
                </div>
            </div>
            <br>
            <p class="text-xl text-gray-800 font-semibold">Descrição</p>
            <hr>
            <br>
            <div class="my-2 mx-1" style="all: unset">
                {!! $produto->descricao !!}
            </div>
        </x-container-principal>
    </x-app-layout>
