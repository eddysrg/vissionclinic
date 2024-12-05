<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

</head>

<body>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-[#ffffff] via-[#0e58c4] via-63% to-[#090a14] to-76%">

        <h1 class="text-5xl uppercase text-[#070C3D]">Registro de usuarios del ECE</h1>

        <div
            class="grid w-full sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-b from-[#0D418F] to-[#041329] shadow-md overflow-hidden sm:rounded-lg">

            <div class="flex justify-center items-center gap-3 pt-8">
                <img src="{{asset('images/login_icono.svg')}}" alt="Login VCL icono">
                <h2 class="text-3xl text-white font-normal">Bienvenido</h2>
            </div>

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />


                @livewire('pages.auth.login-register')
            </div>

            <div class="w-32 py-5 flex justify-self-end">
                <picture>
                    <source srcset="{{asset('images/ece_white_logo.webp')}}" type="image/webp">
                    <img src="{{asset('images/ece_white_logo.png')}}" alt="ECE logo">
                </picture>
            </div>
        </div>

        <div class="mt-10 text-center text-white">
            <p>® GDC DataComm | 2024</p>
            <p>Este sitio está diseñado para ser utilizado con el navegador Google Chrome o Mozilla Firefox</p>
        </div>
    </div>

    @livewireScripts
</body>

</html>