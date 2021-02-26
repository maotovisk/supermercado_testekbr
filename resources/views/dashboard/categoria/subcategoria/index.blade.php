@section('title', $categoria->titulo.' > Subcategorias')
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold"><a href="{{ route('categorias') }}" > Categorias </a> > <a href="{{ route('categorias.subcategorias', $categoria->id) }}">{{ $categoria->titulo }} </a> > Subcategorias</p>
                <div>
                    <x-botao-link :href="route('categorias')">Voltar</x-botao-link>
                    @if (Auth::user()->is_admin)
                        <x-botao-link :href="route('categorias.subcategorias.novo', $categoria->id)">Adicionar Nova</x-botao-link>
                    @endif
                </div>
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />


        <x-container-principal>
            @if (count($subcategorias) > 0)
                <x-controle-tabelas>
                    Filtros
                </x-controle-tabelas>
                <x-tabela>
                    <thead class="bg-gray-50 text-gray-500 text-sm">
                        <tr class="divide-x divide-gray-300">
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantidade de
                                Produtos
                            </th>
                            @if (Auth::user()->is_admin)
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    Controles</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-500 text-xs divide-y divide-gray-200">
                        @foreach ($subcategorias as $subcategoria)
                            <tr>
                                <td class="py-2 px-3">{{ $subcategoria->titulo }}</td>
                                <td class="py-2 px-3">{{ count($subcategoria->produtos) }}</td>
                                @if (Auth::user()->is_admin)
                                    <td class="py-2">
                                        <x-grupo-editar-deletar :deletar="route('categorias.subcategorias.excluir', [$categoria->id, $subcategoria->id])" :editar="route('categorias.subcategorias.editar', [$categoria->id, $subcategoria->id])" />
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </x-tabela>

                <div class="m-6">
                    <hr>
                    <br>
                    {{ $subcategorias->links() }}
                </div>
            @else
                <p>Não há subcategorias cadastradas.</p>
            @endif
        </x-container-principal>
    </x-app-layout>
