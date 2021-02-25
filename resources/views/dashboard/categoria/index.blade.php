@section('title', 'Categorias')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Categorias') }}</p>
                @if (Auth::user()->is_admin)
                    <button onclick="window.location.href='{{route('categorias.novo')}}'" class="bg-gray-800 hover:bg-gray-900 text-white text-xs px-6 py-2 rounded-lg border-0">Adicionar
                        Nova</button>
                @endif
            </div>
        </x-slot>

        <x-aviso-sessao class="mb-4" :message="session('status') ?? ''" />
        <x-erro-sessao class="mb-4" :message="session('error') ?? ''" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            class="flex flex-wrap justify-between items-center bg-white border-b p-2 space-y-2 md:space-y-0">
                            <div class="space-x-1 mb-1 sm:mb-0">
                                Filtros
                            </div>
                        </div>
                        <div class="flex flex-col max-w-full shadow-md m-6">
                            <table class="overflow-x-auto w-full bg-white divide-y divide-gray-200">
                                <thead class="bg-gray-50 text-gray-500 text-sm">
                                    <tr class="divide-x divide-gray-300">
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome
                                        </th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantidade de Produtos
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
                                            <td class="py-2 px-3">{{ count($categoria->produtos )}}</td>
                                            @if (Auth::user()->is_admin)
                                                <td class="py-2">
                                                    <div
                                                        class="flex flex-wrap justify-start md:justify-center items-center space-x-0 space-y-2 sm:space-x-2 sm:space-y-0">
                                                        <div class="divide-x-2 border border-gray-300 shadow-sm rounded-md">
                                                            <button onclick="window.location.href='{{route('categorias.editar', $categoria->id)}}'" class="p-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    class="h-4 w-4 text-indigo-500">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                </svg>
                                                            </button>

                                                            <button class="p-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    class="h-4 w-4 text-red-500">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="m-6">
                            <hr>
                            <br>
                            {{ $categorias->links() }}
                        </div>
                    </div>
                    
                </div>
            </div>
    </x-app-layout>
