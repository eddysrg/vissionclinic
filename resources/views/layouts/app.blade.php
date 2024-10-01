<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vission Clinic | ECE</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-screen flex">
    <livewire:layout.navigation />

    <section class="w-full h-full relative">
        <header class="bg-[#41759D] px-8 py-3">
            <div class="flex items-center justify-end gap-5">
                <div class="w-8">
                    <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open" class="text-white">
                        Bienvenido(a) {{Auth::user()->name}}
                        <i class="fa-solid fa-caret-down text-white"></i>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-50 bg-[#41759D] mt-5 rounded-md shadow-lg w-40 p-5">
                        <ul class="space-y-6 text-sm">
                            <li class="text-white">
                                <a href="">Mi perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main>
            {{$slot}}
        </main>

        <div class="bg-[#174075] w-fit px-5 py-1 text-white fixed right-0 bottom-0">
            <p class="text-sm">NOM-004-SSA3-2012 EXPEDIENTE CLÍNICO</p>
        </div>
    </section>

</body>

</html>