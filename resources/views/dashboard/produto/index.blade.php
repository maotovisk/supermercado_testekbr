@section('title', 'Produtos')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Produtos') }}</p>
                @if (Auth::user()->is_admin)
                    <x-botao-link :href="route('produtos.novo')">Adicionar Novo</x-botao-link>
                @endif
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />

        <x-container-principal>
            @if (count($produtos) > 0)
                <x-controle-tabelas>
                    Filtros
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
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ativo
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
                                <td class="py-2 px-3">{{ $produto->valor }}</td>
                                <td class="py-2 px-3">
                                    <span
                                        class="bg-indigo-200 text-indigo-500 text-xs font-semibold rounded-md py-1 px-2">{{ $produto->is_active ? 'Sim' : 'Não' }}</span></td>
                                <td class="py-2 px-3 text-center"><x-botao-link :href="route('produtos.ver', $produto->id)">Ver</x-botao-link></td>
                                @if (Auth::user()->is_admin)
                                    <td class="py-2">
                                        <x-grupo-editar-deletar :deletar="route('produtos.excluir', $produto->id)" :editar="route('produtos.editar', $produto->id)" />
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </x-tabela>

                <div class="m-6">
                    <hr>
                    <br>
                    {{ $produtos->links() }}
                </div>
            @else
                <p>Não há produtos cadastrados.</p>
            @endif
        </x-container-principal>
    </x-app-layout>
