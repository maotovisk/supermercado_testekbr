@section('title', 'Usuários')

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <p class="text-xl text-gray-800 font-semibold">{{ __('Adicionar Usuário') }}</p>
                <button onclick="window.location.href='{{ route('users') }}'"
                    class="bg-gray-400 hover:bg-gray-900 text-white text-xs px-6 py-2 rounded-lg border-0">Voltar</button>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <!-- Erros de validação -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('users.registrar') }}">
                            
                            <!-- Token do CSRF (para impedir alguem dar post no target desse form por fora da página) -->
                            @csrf

                            <!-- Nome -->
                            <div>
                                <x-label for="name" :value="__('Nome')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                    required autofocus />
                            </div>


                            <!-- Sobrenome -->
                            <div>
                                <x-label for="surname" :value="__('Sobrenome')" />

                                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                                    :value="old('surname')" required />
                            </div>


                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required />
                            </div>

                            <!-- Senha -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Senha')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                    autocomplete="new-password" />
                            </div>

                            <!-- Confirmar a senha -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" :value="__('Confirmar a senha')" />

                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required />
                            </div>

                            <!-- Administrador -->
                            <div class="block mt-4">
                                <label for="is_admin" class="inline-flex items-center">
                                    <input  {{old('admin') == 'on' ? "checked" :"" }} value="off" id="is_admin" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="admin">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Administrador') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Adicionar') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
