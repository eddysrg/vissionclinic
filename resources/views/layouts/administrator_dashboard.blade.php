<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>
    <title>Administrador | Dashboard</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex">

    <aside class="w-60 h-screen bg-[#174075]">
        <div class="w-32 mx-auto mt-10">
            <img src="{{asset('images/ece_white_logo.png')}}" alt="ECE logo" class="w-full h-auto">
        </div>

        <nav class="mt-14 px-8">
            <a href="" class="flex items-center gap-3 text-white text-sm">
                <i class="fa-solid fa-users"></i>
                Administrar usuarios
            </a>
        </nav>
    </aside>

    {{$slot}}

</body>
</html>