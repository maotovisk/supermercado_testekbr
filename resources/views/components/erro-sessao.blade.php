@props(['message'])

@if ($message)
    <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="opacity-90 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 opacity-90 bg-white border-b border-gray-200">
                        <div {{ $attributes->merge(['class' => 'font-medium text-sm text-red-600']) }}>
                            {{ $message }}
                        </div>
                </div>
            </div>
        </div>
    </div>
@endif
