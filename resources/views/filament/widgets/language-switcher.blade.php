<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex items-center space-x-2">

        @php
            $languages = config('language');
        @endphp

        @isset($languages)
            @foreach($languages as $locale => $lang)
                <a href="{{ route('change-locale', $locale) }}"
                   class="px-2 py-1 text-sm hover:bg-amber-200 rounded transition"
                   title="{{ $lang['lang_name'] }}">
                    {{ $lang['flag'] ?? strtoupper($locale) }}
                </a>
            @endforeach
        @endisset

    </div>
</div>
