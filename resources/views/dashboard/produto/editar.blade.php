@section('title', 'Editar Produto')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Adicionar Produto') }}</p>
                <x-botao-link :href="route('produtos')">Voltar</x-botao-link>
            </div>
        </x-slot>

        <x-container-principal>
            <!-- Erros de validação -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" enctype="multipart/form-data" action="{{ route('produtos.atualizar', $produto->id) }}">

                <!-- Token do CSRF (para impedir alguem dar post no target desse form por fora da página) -->
                @csrf

                <!-- Nome -->
                <div>
                    <x-label for="tilulo" :value="__('Título')" />

                    <x-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="$produto->titulo" required
                        autofocus />
                </div>
                <br>
                <!-- Valor -->
                <div>
                    <x-label for="valor" :value="__('Preço')" />

                    <x-input id="valor" class="block mt-1 w-full" type="number" min="0"  step=".01" name="valor" :value="$produto->valor" required/>
                </div>
                <br>

                <!-- Categoria -->
                <div>
                    <x-label for="categoria_id" :value="__('Categoria')" />
                    @if (count($categorias) > 0)
                        <x-select onchange="populateSelect('select_subcategoria', this.value)" :name="'categoria_id'" :id="'categoria_select'">
                            @foreach ($categorias as $cat)
                                <option @if ($cat->id == $produto->categoria->id) selected @endif value="{{ $cat->id }}">{{ $cat->titulo }}</option>
                            @endforeach
                        </x-select>
                    @endif
                </div>
                <br>

                <!-- Subcategorias -->
                <div>
                    <x-label for="subcategoria_id" :value="__('Subcategoria')" />
                    <x-select :name="'subcategoria_id'" :id="'select_subcategoria'">
                        @foreach ($selectedCategoria->subcategorias as $subcat)
                            <option @if ($subcat->id == $produto->subcategoria_id) selected @endif  value="{{ $subcat->id }}">{{$subcat->titulo}}</option>
                        @endforeach
                    </x-select>
                </div>
                <br>

                <!-- Descrição -->
                <div>
                    <x-label for="descricao" :value="__('Descrição')" />

                    <textarea class="reset-all-styles" id="descricao" placeholder="Descrição do produto" name="descricao">{{ $produto->descricao }}</textarea>
                </div>
                <br>

                <!-- Foto -->
                <div>
                    <x-label for="imagem" :value="__('Imagem')" />

                    <x-input id="imagem" class="block mt-1 w-full" type="file" name="imagem" />
                </div>
                <br>


                <!-- Ativo -->
                <div class="block mt-4">
                    <x-label for="active" :value="__('Ativar Produto')" />
                    <label for="is_active" class="inline-flex items-center">
                    <input {{ $produto->is_active ? 'checked' : '' }} value="{{ $produto->is_active ? 'on' : 'off' }}"
                        id="is_active" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="active">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ativo') }}</span>
                </label>
                </div>
                <br>

                <!-- Google reCaptcha v2 -->
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}""></div>
                    

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4 g-recaptcha">
                        {{ __('Atualizar') }}
                    </x-button>
                </div>
            </form>

        <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            ClassicEditor
            .create( document.querySelector( '#descricao' ) )
            .catch( error => {
            console.error( error );
            } );
            
            const SUBCATEGORIAS = {!! json_encode($subcategorias->toArray(), JSON_HEX_TAG) !!};

            function populateSelect(id, categoriaID) {
                let selectSub = document.getElementById(id);
                selectSub.innerHTML = "";
                for (subcategoria of SUBCATEGORIAS) {
                    if (subcategoria.categoria_id == categoriaID) {
                        option = document.createElement('option');
                        option.setAttribute('value', subcategoria.id);
                        option.appendChild(document.createTextNode(subcategoria.titulo));
                        selectSub.appendChild(option);
                    }
                }
            }
            </script>
        </x-container-principal>
    </x-app-layout>
