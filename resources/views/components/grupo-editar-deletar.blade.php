@props(['editar', 'deletar'])

<div class="flex flex-wrap justify-start md:justify-center items-center space-x-0 space-y-2 sm:space-x-2 sm:space-y-0">
    <div class="divide-x-2 border border-gray-300 shadow-sm rounded-md">
        <button onclick="window.location.href='{{ $editar }}'" class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-4 w-4 text-indigo-500">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </button>

        <button onclick="confirmRedirect('{{ $deletar ?? '' }}', 'Você tem certeza que deseja deletar esse item?')" class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-4 w-4 text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </div>
</div>
