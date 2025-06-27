<details class="dropdown bg-amber-100 rounded-2xl relative group cursor-pointer p-2">
    <summary class="flex items-center space-x-1 cursor-pointer list-none">
        <!-- Icono del globo
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
        </svg>
-->
        <!-- flag seleccionado en la sesión-->
        @php
            $locale =  session()->get('locale') ?? request()->cookie('locale')?? app()->getLocale();
        @endphp
        {{config("language")[$locale]['flag']}}
        <!-- Flecha abajo -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
        </svg>


    </summary>

    <!-- Menú desplegable -->
    <div class="absolute z-50 mt-2 flex flex-col bg-white rounded-xl shadow p-2 w-32">
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
</details>
