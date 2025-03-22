<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>

    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet"
    />

    {{$fullCalendarJs ?? ''}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (request()->is('profile'))
    @vite('resources/js/profile.js')
    @endif
</head>

<body class="db-body">

    <header class="db-header">
        <div class="db-header__menu">
            <div class="db-header__photo-container">

            </div>

            <div class="db-header__menu-title">
                <p>Bienvenido Dr Luis Flores</p>
                <i class="ri-arrow-down-s-fill db-header__menu-icon"></i>
            </div>
        </div>
    </header>

    <livewire:components.dashboard-nav />

    <main class="db-main">
        {{$slot}}
    </main>

    {{--<section class="w-full h-full relative">
        <header class="bg-[#41759D] px-8 py-2">
            <div class="flex items-center justify-end gap-5">
                @if(auth()->user()->profile_photo)
                <div class="w-7 h-7 aspect-square object-cover rounded-full overflow-hidden">
                    <img src="{{asset('storage/' . auth()->user()->profile_photo)}}" alt="Profile photo">
                </div>
                @else
                <div class="w-7">
                    <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
                </div>
                @endif

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="text-white text-sm">
                        <x-user-name :isHeader='true' />
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-50 bg-[#41759D] mt-5 rounded-md shadow-lg w-40" style="display: none">
                        <ul class="text-sm">
                            <li
                                class="text-white p-3 hover:bg-slate-300 hover:rounded-md hover:duration-300 hover:text-[#41759D]">
                                <a href="{{route('profile')}}">Mi perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <section class="mt-5">
            {{$slot}}
        </section>

        <div class="bg-[#174075] w-fit px-5 py-1 text-white fixed right-0 bottom-0 z-50 hidden xl:block">
            <p class="text-sm">NOM-004-SSA3-2012 EXPEDIENTE CLÍNICO</p>
        </div>
    </section>--}}

</body>

</html>
