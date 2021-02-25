@section('title', 'Usuários')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Users') }}</p>
                @if (Auth::user()->is_admin)
                    <x-botao-link :href="route('users.novo')">Adicionar Novo</x-botao-link>
                @endif
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />


        <x-container-principal>
            @if (count($users) > 0)
                <x-controle-tabelas>
                    Filtros
                </x-controle-tabelas>
                <x-tabela>
                    <thead class="bg-gray-50 text-gray-500 text-sm">
                        <tr class="divide-x divide-gray-300">
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                Email
                            </th>
                            @if (Auth::user()->is_admin)
                                <th class="px-2 [py-2] text-left text-xs font-medium text-gray-500 uppercase">
                                    Administrador</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    Controles</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-500 text-xs divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 px-3">{{ $user->name . ' ' . $user->surname }}</td>
                                <td class="py-2 px-3">{{ $user->email }}</td>

                                @if (Auth::user()->is_admin)
                                    <td class="py-2 px-3">
                                        <span
                                            class="bg-indigo-200 text-indigo-500 text-xs font-semibold rounded-md py-1 px-2">{{ $user->is_admin ? 'Sim' : 'Não' }}</span>
                                    </td>
                                    <td class="py-2">
                                        <x-grupo-editar-deletar :editar="route('users.editar', $user->id)" />
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </x-tabela>

                <div class="m-6">
                    <hr>
                    <br>
                    {{ $users->links() }}
                </div>
            @else
                <p>Não há categorias.</p>
            @endif

        </x-container-principal>

    </x-app-layout>
