@section('title', 'Categorias')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Categorias') }}</p>
                @if (Auth::user()->is_admin)
                    <x-botao-link :href="route('categorias.novo')">Adicionar Nova</x-botao-link>
                @endif
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />


        <x-container-principal>
            @if (count($categorias) > 0)
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
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="py-2 px-3">{{ $categoria->titulo }}</td>
                                <td class="py-2 px-3">{{ count($categoria->produtos) }}</td>
                                @if (Auth::user()->is_admin)
                                    <td class="py-2">
                                        <x-grupo-editar-deletar :editar="route('categorias.editar', $categoria->id)" />
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </x-tabela>

                <div class="m-6">
                    <hr>
                    <br>
                    {{ $categorias->links() }}
                </div>
            @else
                <p>Não há categorias cadastradas.</p>
            @endif
        </x-container-principal>
    </x-app-layout>
