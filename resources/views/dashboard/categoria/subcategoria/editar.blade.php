@section('title', $categoria->titulo.' > Subcategorias')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold"><a href="{{ route('categorias') }}" > Categorias </a> > <a href="{{ route('categorias.subcategorias', $categoria->id) }}">{{ $categoria->titulo }} </a> > Editar Subcategoria</p>
                <x-botao-link :href="route('categorias.subcategorias', $categoria->id)">Voltar</x-botao-link>
            </div>
        </x-slot>


        <x-container-principal>
            <!-- Erros de validação -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('categorias.subcategorias.atualizar', ['categoria_id' => $categoria->id, 'id'=>$subcategoria->id]) }}">

                <!-- Token do CSRF (para impedir alguem dar post no target desse form por fora da página) -->
                @csrf

                <!-- Nome -->
                <div>
                    <x-label for="tilulo" :value="__('Título')" />

                    @if (count($categorias) > 0)
                        <x-select :name="'categoria_id'" :id="'categoria_select'">
                            @foreach ($categorias as $cat)
                                <option @if($cat->id == $categoria->id) selected="selected" @endif value="{{ $cat->id }}">{{$cat->titulo}}</option>
                            @endforeach
                        </x-select>
                    @endif

                    <x-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="$subcategoria->titulo"
                        required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Atualizar') }}
                    </x-button>
                </div>
            </form>

        </x-container-principal>

    </x-app-layout>
