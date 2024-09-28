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
    <aside class="w-72 h-5/6 bg-[#174075] flex flex-col items-center justify-evenly">
        <div class="w-52">
            <img src="{{asset('images/ece_white_logo.png')}}" alt="Logo ece blanco">
        </div>

        <div class="w-28">
            <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
        </div>

        <nav>
            <ul class="space-y-5 uppercase text-sm">
                <li class="text-white">
                    <i class="fa-solid fa-house mr-3"></i>
                    <a href="{{route('dashboard')}}">Inicio</a>
                </li>
                <li class="text-white">
                    <i class="fa-solid fa-user-group mr-3"></i>
                    <a href="{{route('dashboard.expedientes')}}">Expedientes</a>
                </li>
                <li class="text-white">
                    <i class="fa-solid fa-calendar-days mr-3"></i>
                    Agenda
                </li>

                <li class="text-white flex">
                    <i class="fa-solid fa-right-from-bracket mr-3"></i>
                    <form method="POST" action="">
                        @csrf
                        <a href="#">
                            <input type="submit" value="Cerrar Sesión" class="uppercase cursor-pointer">
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </aside>

    <section class="w-full h-full relative">
        <header class="bg-[#41759D] px-8 py-3">
            <div class="flex items-center justify-end gap-5">
                <div class="w-8">
                    <img src="{{asset('images/imagen_perfil.svg')}}" alt="Profile photo">
                </div>
                <p class="text-white">Bienvenido(a) {{Auth::user()->name}}</p>
                <i class="fa-solid fa-caret-down text-white"></i>
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