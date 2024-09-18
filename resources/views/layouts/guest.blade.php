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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-[#ffffff] via-[#0e58c4] via-63% to-[#090a14] to-76%">

        <h1 class="text-5xl uppercase text-[#070C3D]">Expediente Clínico Electrónico</h1>

        <div
            class="grid w-full sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-b from-[#0D418F] to-[#041329] shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex justify-center items-center gap-3 pt-8">
                <img src="{{asset('images/login_icono.svg')}}" alt="Login Bluecare icono">
                <h2 class="text-3xl text-white font-normal">Bienvenido</h2>
            </div>

            {{ $slot }}

            <div class="w-20 py-5 justify-self-end">
                <img src="{{asset('images/logo_bluecare_blanco.svg')}}" alt="Logo bluecare blanco">
            </div>
        </div>

        <div class="mt-10 text-center text-white">
            <p>® GDC DataComm | 2024</p>
            <p>Este sitio está diseñado para ser utilizado con el navegador Google Chrome o Mozilla Firefox</p>
        </div>


    </div>
</body>

</html>