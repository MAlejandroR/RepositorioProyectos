<x-filament::page>
    <x-slot name="header">
       <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-10" alt="Logo CPIFP"/>
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">
{{--                {{ __('panel.project_repository') }}--}}
            </h1>
        </div>
    </x-slot>

    {{-- Aquí tu contenido de tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-4">
        <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Projects') }}</h2>
            <p class="text-2xl font-bold">{{ $projectsCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Teachers') }}</h2>
            <p class="text-2xl font-bold">{{ $teachersCount }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Queries') }}</h2>
            <p class="text-2xl font-bold">{{ $queriesCount }}</p>
        </div>
    </div>
</x-filament::page>
