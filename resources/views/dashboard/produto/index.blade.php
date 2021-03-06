@section('title', 'Produtos')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Produtos') }}</p>
                <div>
                    @if (count($produtos) > 0)
                        <x-botao-download onclick="exportar('pdf')">Exportar como PDF</x-botao-download>
                        <x-botao-download onclick="exportar('csv')">Exportar como CSV</x-botao-download>        
                    @endif
                    @if (Auth::user()->is_admin)

                        <x-botao-link :href="route('produtos.novo')" >Adicionar Novo</x-botao-link>
                    @endif
                </div>
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />

        <x-container-principal>
            @if (count($produtos) > 0)
            <div class="my-3">
            <p class="text-xl text-gray-800 font-semibold">{{ __('Destaques') }}</p>
                @if (count($destaques) > 0)
                <div class="flex mt-3 overflow-y">
                    @foreach ($destaques as $destaque)
                        <div class="bg-grey overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200flex-col justify-center">
                                <p> {{$destaque->produto->titulo}} </p>
                                <p class="py-2 px-3">R$ {{ $destaque->produto->valor }}</p>
                                <x-botao-link :href="route('produtos.ver', $destaque->produto->id)">Ver</x-botao-link>
                                @if (Auth::user()->is_admin)
                                    <x-botao-link :href="route('destaques.remover',$destaque->id)" >Remover</x-botao-link>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <span>Não há destaques cadastrados</span>
                @endif
            </div>
                <hr>
                <x-controle-tabelas>
                    <div style="width:100%" class="flex flex-grow justify-between items-center">
                        <div class="flex">
                            <div>
                                <label for="select_categoria">Categoria: </label>
                                <select name="select_categoria" onchange="sendRequest('categoria', this.value)">
                                    <option value="todas">Todas</option>
                                    @foreach ($categorias as $categoria)
                                        <option @if ($scategoria == $categoria->id) selected @endif value="{{ $categoria->id }}">
                                            {{ $categoria->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if (is_numeric($scategoria) || is_numeric($ssubcategoria))
                                <div class="px-4">
                                    <label for="select_subcategoria">Subcategoria: </label>
                                    <select name="select_subcategoria" onchange="sendRequest('subcategoria', this.value)">
                                        <option value="todas">Todas</option>
                                        @foreach ($subcategorias as $subcategoria)
                                            <option @if ($ssubcategoria == $subcategoria->id) selected @endif value="{{ $subcategoria->id }}">
                                                {{ $subcategoria->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="select_order">Ordernar: <label>
                                    <select name="select_order" onchange="sendRequest('ordernar', this.value)">
                                        <option value="todas">Nenhuma</option>
                                        <option value="1">Menor Preço</option>
                                        <option value="2">Maior Preço</option>
                                        <option value="3">Ordem Alfabética (A-Z)</option>
                                        <option value="4">Ordem Alfabética (Z-A)</option>
                                    </select>
                        </div>

                    </div>
                </x-controle-tabelas>
                <x-tabela>
                    <thead class="bg-gray-50 text-gray-500 text-sm">
                        <tr class="divide-x divide-gray-300">
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Categoria
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Subcategoria
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Valor
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Detalhes
                            </th>
                            @if (Auth::user()->is_admin)
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    Controles</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-500 text-xs divide-y divide-gray-200">
                        @foreach ($produtos as $produto)
                            <tr>
                                <td class="py-2 px-3">{{ $produto->titulo }}</td>
                                <td class="py-2 px-3">{{ $produto->categoria->titulo }}</td>
                                <td class="py-2 px-3">{{ $produto->subcategoria->titulo }}</td>
                                <td class="py-2 px-3">R$ {{ $produto->valor }}</td>
                                <td class="py-2 px-3">
                                    <span
                                        class="bg-indigo-200 text-indigo-500 text-xs font-semibold rounded-md py-1 px-2">{{ $produto->is_active ? 'Ativo' : 'Inativo' }}</span>
                                </td>
                                <td class="py-2 px-3 text-center">
                                    <x-botao-link :href="route('produtos.ver', $produto->id)">Ver</x-botao-link>
                                </td>
                                @if (Auth::user()->is_admin)
                                    <td class="py-2">
                                        <x-grupo-editar-deletar :destacar="route('destaques.adicionar', $produto->id)" :deletar="route('produtos.excluir', $produto->id)"
                                            :editar="route('produtos.editar', $produto->id)" />
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </x-tabela>

                <div class="m-6">
                    <hr>
                    <br>
                    {{ $produtos->appends(request()->input())->links() }}
                </div>
            @else
                <p>Não há produtos cadastrados.</p>
            @endif
        </x-container-principal>

        <script>
            function sendRequest(tipo, id) {

                var queryParams = new URLSearchParams(window.location.search);

                if (id != "todas") {
                    if (tipo == "categoria") {
                        queryParams.set("categoria", id);
                        queryParams.set("page", 1);
                    }
                    if (tipo == "subcategoria") {
                        queryParams.set("subcategoria", id);
                        queryParams.set("page", 1);
                    }
                    if (tipo == "ordernar") {
                        queryParams.set("orderBy", id);
                        queryParams.set("page", 1);
                    }
                } else {
                    if (tipo == "categoria")
                        queryParams.delete('categoria')
                    queryParams.delete("subcategoria");

                    if (tipo == "subcategoria")
                        queryParams.delete("subcategoria");
                    if (tipo == "ordernar")
                        queryParams.delete("orderBy");
                }


                history.replaceState(null, null, "?" + queryParams.toString());
                location.reload();
            }

            function exportar(tipo) {

                var queryParams = new URLSearchParams(window.location.search);

                if (tipo == 'pdf') {
                    queryParams.set("tipo", 'pdf');

                }
                if (tipo == 'csv') {
                    queryParams.set("tipo", 'csv');

                }


                window.location.replace('{{ route('produtos.exportar') }}?' + queryParams.toString());
            }

        </script>
    </x-app-layout>
