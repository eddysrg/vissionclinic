<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registro general | Vissionclinic</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body>

    <x-notification />

    <header class="bg-[#174075]">
        <div class="px-10 flex justify-between items-center">
            <div class="w-40">
                <img src="{{asset('images/ece_white_logo.png')}}" alt="">
            </div>

            <nav class="flex items-center gap-3">
                <a class="text-white border-b-4 p-3" href="">Registro</a>
                <a class="text-white p-3" href="">Usuarios</a>
            </nav>

        </div>
    </header>

    <h2 class="py-10 text-center text-xl text-[#174075] uppercase">Registro/Alta de nueva clínica o consultorio</h2>

    <div class="w-4/5 py-5 mx-auto">
        @livewire('pages.auth.register')
    </div>

    @livewireScripts
</body>

</html>