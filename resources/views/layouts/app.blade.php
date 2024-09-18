<?php 
    use Carbon\Carbon;
    $fechaHoy = Carbon::now()->isoFormat('D [de] MMMM YYYY');

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-screen flex">
    {{-- <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}
    <aside class="w-72 h-5/6 bg-[#174075] flex flex-col items-center justify-evenly">
        <div class="w-28">
            <img src="{{asset('images/logo_bluecare_blanco.svg')}}" alt="Logo bluecare blanco">
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
                    Expedientes
                </li>
                <li class="text-white">
                    <i class="fa-solid fa-calendar-days mr-3"></i>
                    Agenda
                </li>

                <li class="text-white flex">
                    <i class="fa-solid fa-right-from-bracket mr-3"></i>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{route('logout')}}">
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

        <div class="flex">
            <div class="w-2/3 p-8">
                <div class="bg-[#41759D40] p-5">
                    <h2 class="text-2xl">¡Hola {{Auth::user()->name}}!</h2>
                    <p>¿Qué quieres hacer hoy?</p>

                    <div class="mt-8 w-full flex justify-evenly">
                        <button class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                            Registro Paciente Nuevo
                            <i class="fa-solid fa-plus ml-2"></i>
                        </button>

                        <button class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                            Agendar Cita
                            <i class="fa-solid fa-plus ml-2"></i>
                        </button>

                        <button class="text-xs text-white bg-[#41759D] p-3 rounded-md">
                            Revisar Agenda
                            <i class="fa-solid fa-plus ml-2"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-10 border border-zinc-300 p-5">
                    <h3>Citas de hoy: <span class="font-semibold">{{$fechaHoy}}</span></h3>

                    <div class="grid grid-cols-5 gap-x-5 mt-3">
                        <div class="border border-zinc-300 flex flex-col items-center p-2">
                            <p
                                class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                                DH
                            </p>

                            <div class="mt-3 text-xs text-center space-y-2">
                                <p class="">Diego Hernandez</p>
                                <p class="">2:30 pm</p>
                                <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                            </div>
                        </div>

                        <div class="border border-zinc-300 flex flex-col items-center p-2">
                            <p
                                class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                                DH
                            </p>

                            <div class="mt-3 text-xs text-center space-y-2">
                                <p class="">Diego Hernandez</p>
                                <p class="">2:30 pm</p>
                                <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                            </div>
                        </div>

                        <div class="border border-zinc-300 flex flex-col items-center p-2">
                            <p
                                class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                                DH
                            </p>

                            <div class="mt-3 text-xs text-center space-y-2">
                                <p class="">Diego Hernandez</p>
                                <p class="">2:30 pm</p>
                                <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                            </div>
                        </div>

                        <div class="border border-zinc-300 flex flex-col items-center p-2">
                            <p
                                class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                                DH
                            </p>

                            <div class="mt-3 text-xs text-center space-y-2">
                                <p class="">Diego Hernandez</p>
                                <p class="">2:30 pm</p>
                                <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                            </div>
                        </div>

                        <div class="border border-zinc-300 flex flex-col items-center p-2">
                            <p
                                class="text-2xl bg-slate-700 w-fit aspect-square px-2 py-2 rounded-full flex items-center text-white">
                                DH
                            </p>

                            <div class="mt-3 text-xs text-center space-y-2">
                                <p class="">Diego Hernandez</p>
                                <p class="">2:30 pm</p>
                                <p class="bg-red-600 text-white p-1 rounded-full">Sin confirmar</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="w-1/3 p-8">
                <p class="bg-[#0E2F5E] text-white text-center py-2 uppercase">Notificaciones</p>
                <p class="text-[#0E2F5E] text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="text-[#0E2F5E] text-center py-2">Videoconsulta 6:30 pm</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
                <p class="text-[#0E2F5E] text-center py-2">Paciente nuevo agregado</p>
                <p class="bg-[#174075] text-white text-center py-2">Paciente nuevo agregado</p>
            </div>
        </div>




        <div class="bg-[#174075] w-fit px-5 py-1 text-white fixed right-0 bottom-0">
            <p class="text-sm">NOM-004-SSA3-2012 EXPEDIENTE CLÍNICO</p>
        </div>
    </section>



</body>

</html>