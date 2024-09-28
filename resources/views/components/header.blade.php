<header class="bg-[#0144E8] xl:px-20 xl:pt-3">
    <div class="p-5 xl:p-0 flex items-center justify-between ">

        <a class="lg:hidden text-xs py-3 px-5 bg-[#0A125E] text-white rounded-lg" href="">Iniciar Sesión</a>


        <a href="{{route('home')}}" class="w-32 xl:w-40">
            <x-white-logo />
        </a>

        <div class="hidden lg:flex lg:items-center lg:gap-10 xl:gap-32">
            <div class="flex items-center gap-3">
                <div class="w-9">
                    <img src="{{asset('images/atencion_icono.png')}}" alt="Atención Icono">
                </div>

                <div class="text-white lg:text-xs 2xl:text-base ">
                    <p class="font-thin text-slate-200">Horario de atención</p>
                    <p>Lunes-Viernes 9am-7pm</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-9">
                    <img src="{{asset('images/llamanos_icono.png')}}" alt="Atención Icono">
                </div>

                <div class="text-white lg:text-xs 2xl:text-base">
                    <p class="font-thin text-slate-200">Llámanos</p>
                    <p>55 5449 6250</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-9">
                    <img class="filter grayscale brightness-200" src="{{asset('images/escribenos_icono.png')}}"
                        alt="Atención Icono">
                </div>

                <div class="text-white lg:text-xs 2xl:text-base">
                    <p class="font-thin text-slate-200">Escríbenos</p>
                    <p>vissionclinic.ece@gdc-cala.com.mx</p>
                </div>
            </div>

        </div>
    </div>

    <nav class="bg-[#0A125E] lg:mt-3 flex justify-between items-center  py-3 lg:py-5 px-5 lg:px-8 relative">

        <i class="lg:hidden text-4xl text-white fa-solid fa-bars"></i>

        <ul class="navBar hidden text-white uppercase font-medium lg:flex lg:items-center lg:gap-8">
            <li class="link hover:text-[#0144E8] duration-300">
                <a href="{{route('home')}}">Inicio</a>
            </li>

            <li class="link hover:text-[#0144E8] duration-300">
                <i class="fa-solid fa-chevron-right mr-2 rotate-0"></i>
                <p class="inline cursor-pointer">Exp. Clínico</p>
            </li>

            <li class="hidden submenu-exp absolute top-full left-28 z-20 bg-[#0A125E] w-40 p-5">
                <ul class="space-y-6 text-sm pl-5">
                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('ece', ['nivel' => 'nivel-uno'])}}">Nivel 1</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('ece', ['nivel' => 'nivel-dos'])}}">Nivel 2</a>
                    </li>
                </ul>
            </li>

            <li class="link hover:text-[#0144E8] duration-300">
                <a href="{{route('mvs')}}">Medical View System</a>
            </li>

            <li class="link hover:text-[#0144E8] duration-300">
                <a href="{{route('lyrium')}}">Lyrium</a>
            </li>

            <li class="link hover:text-[#0144E8] duration-300">
                <i class="fa-solid fa-chevron-right mr-2 rotate-0"></i>
                <p class="inline cursor-pointer">Productos</p>
            </li>

            <li class="hidden submenu-pro absolute top-full left-[35rem] z-20 bg-[#0A125E] w-60 p-5">
                <ul class="space-y-6 text-sm pl-5">

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('productos')}}">Todos los productos</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'laboratorio'])}}">Laboratorio</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'ingresos'])}}">Ingresos</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'medical-view-system'])}}">Medical View System</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'odontologia'])}}">Odontología</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'nutricion'])}}">Nutrición</a>
                    </li>

                    <li class="hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'ginecologia'])}}">Ginecología</a>
                    </li>
                </ul>
            </li>

            {{-- <li class="text-xs py-3 px-5 bg-[#0144E8] rounded-lg">
                <a href="">Iniciar Sesión</a>
            </li> --}}

            <li class="link hover:text-[#0144E8] duration-300">
                <a href="{{route('contacto')}}">Contacto</a>
            </li>

            <li class="link hover:text-[#0144E8] duration-300">
                <button id="translate-button" onclick="translateToEnglish()">Traducir</button>
                <div id="google_translate_element" style="display: none;"></div>
            </li>
        </ul>

        {{-- Responsive navbar --}}

        <ul
            class="nav hidden text-white uppercase font-medium absolute bg-[#0144E8] z-20 p-3 py-8 w-full top-full left-0 space-y-6">
            <li class="link-mb">
                <i class="fa-solid fa-chevron-right mr-2"></i>
                <a href=" {{route('home')}}">Inicio</a>
            </li>

            <li class="link-mb">
                <i class="fa-solid fa-chevron-right mr-2 rotate-0"></i>
                <p class="inline">Exp. Clínico</p class="inline">
            </li>

            <li class="hidden submenu-resp-exp">
                <ul class="space-y-6 text-sm pl-5">
                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('ece', ['nivel' => 'nivel-uno'])}}">Nivel 1</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('ece', ['nivel' => 'nivel-dos'])}}">Nivel 2</a>
                    </li>
                </ul>
            </li>

            <li class="link-mb">
                <i class="fa-solid fa-chevron-right mr-2"></i>
                <a href="{{route('mvs')}}">Medical View System</a>
            </li>

            <li class="link-mb">
                <i class="fa-solid fa-chevron-right mr-2"></i>
                <a href="{{route('lyrium')}}">Lyrium</a>
            </li>

            <li class="link-mb">
                <i class="fa-solid fa-chevron-right mr-2 rotate-0"></i>
                <p class="inline">Productos</p>
            </li>

            <li class="hidden submenu-resp-pro">
                <ul class="space-y-6 text-sm pl-5">

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('productos')}}">Todos los productos</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'laboratorio'])}}">Laboratorio</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'ingresos'])}}">Ingresos</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'medical-view-system'])}}">Medical View System</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'odontologia'])}}">Odontología</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'nutricion'])}}">Nutrición</a>
                    </li>

                    <li>
                        <i class="fa-solid fa-chevron-right mr-2"></i>
                        <a href="{{route('producto', ['producto' => 'ginecologia'])}}">Ginecología</a>
                    </li>
                </ul>
            </li>
        </ul>

        <li class="hidden lg:block text-white uppercase bg-[#0144E8] p-3 lg:px-7 rounded-lg">
            <a href="{{route('login')}}">Iniciar Sesión</a>
        </li>

        {{-- <a class="hidden lg:block text-white uppercase bg-[#0144E8] p-3 rounded-lg">Contacto</a> --}}
    </nav>

    @if(!request()->routeIs('home'))
    <div class="py-8 xl:py-0 xl:h-80 flex flex-col justify-center items-center gap-3">
        <h1 class="text-3xl xl:text-6xl text-white uppercase">{{session('title')}}</h1>
        <p class="text-3xl xl:text-6xl text-white uppercase">{{session('subtitle')}}</p>
    </div>
    @endif


</header>