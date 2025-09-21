<!doctype html>
<html lang="{{str_replace('_','-',app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title??'Admin'}}</title>
    @vite(['resources/css/app.css','resources/css/app.css'])
    @filamentAssets
    @livewireStyles
</head>

<body class="bg-gray-300 dark:bg-gray-900 font-sans antialiased">

{{-- Top bar (TopMenu.vue equivalent) --}}

<x-filament.topmenu/>

{{-- Navbar with logo and user menu --}}
<nav
    class="h-11v bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center w-screen p-6">
    <a href="https://cpilosenlaces.com/">
        <x-filament.ApplicationMark class="block h-12 w-auto"/>
    </a>

    <div class="flex items-center gap-4">
        {{-- Language switcher --}}

        <x-filament.LanguageSwitcher/>

        {{--        --}}{{-- User dropdown --}}
        {{--        <x-_filament::dropdown placement="bottom-end">--}}
        {{--            <x-slot name="trigger">--}}
        {{--                <button--}}
        {{--                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">--}}
        {{--                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"--}}
        {{--                         alt="{{ Auth::user()->name }}">--}}
        {{--                </button>--}}
        {{--            </x-slot>--}}
        {{--            {{ __('Profile') }}--}}
        {{--            <x-_filament::dropdown.list.item tag="form" :action="route('logout')" method="POST">--}}
        {{--                @csrf--}}
        {{--                <button type="submit">{{ __('Log Out') }}</button>--}}
        {{--            </x-_filament::dropdown.list.item>--}}
        {{--        </x-_filament::dropdown>--}}
    </div>
</nav>

{{-- Page content --}}

<main class="p-4">
    @yield('content')
</main>


@livewireScripts
</body>
</html>
