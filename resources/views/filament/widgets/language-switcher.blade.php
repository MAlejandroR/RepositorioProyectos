<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex items-center space-x-2">
        @foreach(config("language")as $locale=>$lang)
            <x-filament::button wire:click="setLocale('{{ $locale }}')" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">
                {{ $lang['flag'] ?? strtoupper($locale) }}
            </x-filament::button>
        @endforeach
    </div>
</div>
