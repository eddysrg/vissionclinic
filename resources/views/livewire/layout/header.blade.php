<?php

use Livewire\Volt\Component;

new class extends Component {

}; ?>

<div class="bg-[#0144E8]">
    <header class="xl:px-0 xl:pt-5 max-w-7xl mx-auto">
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
            <ul class="navBar hidden text-white uppercase font-medium lg:flex lg:items-center lg:gap-8">
                <li class="link hover:text-[#0144E8] duration-300">
                    <a href="{{route('home')}}">Inicio</a>
                </li>

                <li>
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="py-3 px-8 md:p-0 hover:text-[#0144E8] duration-300 flex items-center gap-2 uppercase">
                            Expediente Clínico
                            <i :class="open ? 'fa-angle-down': 'fa-angle-right'" class="fa-solid text-sm"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute z-50 bg-[#0144E8] mt-5 rounded-md shadow-lg w-40 p-5" style="display: none">
                            <ul class="space-y-6 text-sm">
                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('ece', ['nivel' => 'nivel-uno'])}}">Nivel 1</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('ece', ['nivel' => 'nivel-dos'])}}">Nivel 2</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="link hover:text-[#0144E8] duration-300">
                    <a href="{{route('mvs')}}">Medical View System</a>
                </li>

                <li class="link hover:text-[#0144E8] duration-300">
                    <a href="{{route('lyrium')}}">Lyrium</a>
                </li>

                <li>
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="py-3 px-8 md:p-0 hover:text-[#0144E8] duration-300 flex items-center gap-2 uppercase">
                            Productos
                            <i :class="open ? 'fa-angle-down': 'fa-angle-right'" class="fa-solid text-sm"></i>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute z-50 bg-[#0144E8] mt-5 rounded-md shadow-lg w-60 p-5" style="display: none">
                            <ul class="space-y-6 text-sm">

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('productos')}}">Todos los productos</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('producto', ['producto' => 'laboratorio'])}}">Laboratorio</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('producto', ['producto' => 'ingresos'])}}">Ingresos</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('producto', ['producto' => 'medical-view-system'])}}">Medical View
                                        System</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('producto', ['producto' => 'odontologia'])}}">Odontología</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('producto', ['producto' => 'nutricion'])}}">Nutrición</a>
                                </li>

                                <li class="hover:text-[#0A125E] duration-500">
                                    <i class="fa-solid fa-chevron-right mr-2"></i>
                                    <a href="{{route('producto', ['producto' => 'ginecologia'])}}">Ginecología</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="link hover:text-[#0144E8] duration-300">
                    <a href="{{route('contacto')}}">Contacto</a>
                </li>
            </ul>
            {{-- Responsive navbar --}}

            <div x-data="{ open: false}">
                <button @click="open = !open">
                    <i :class="open ? 'fa-regular fa-circle-xmark' : 'fa-solid fa-bars'"
                        class="lg:hidden text-2xl text-white"></i>
                </button>

                <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-20px]"
                    class="absolute bg-[#0144E8] z-20 p-3 py-8 w-full top-full left-0" style="display: none">
                    <ul class="text-white text-sm uppercase font-medium space-y-6">
                        <li class="link-mb">
                            <i class="fa-solid fa-chevron-right mr-2"></i>
                            <a href=" {{route('home')}}">Inicio</a>
                        </li>

                        <div x-data="{submenu: false}">
                            <button @click="submenu = !submenu" class="link-mb uppercase">
                                <i class="fa-solid fa-chevron-right mr-2 rotate-0"></i>
                                <p class="inline">Exp. Clínico</p class="inline">
                            </button>

                            <div x-show="submenu" @click.outside="submenu = false"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform translate-y-[-20px]" class="mt-4"
                                style="display: none">
                                <ul class="space-y-6 text-xs pl-5 list-disc ml-2">
                                    <li>
                                        <a href="{{route('ece', ['nivel' => 'nivel-uno'])}}">Nivel 1</a>
                                    </li>

                                    <li>
                                        <a href="{{route('ece', ['nivel' => 'nivel-dos'])}}">Nivel 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <li class="link-mb">
                            <i class="fa-solid fa-chevron-right mr-2"></i>
                            <a href="{{route('mvs')}}">Medical View System</a>
                        </li>

                        <li class="link-mb">
                            <i class="fa-solid fa-chevron-right mr-2"></i>
                            <a href="{{route('lyrium')}}">Lyrium</a>
                        </li>

                        <div x-data="{submenu: false}">
                            <button @click="submenu = !submenu" class="link-mb uppercase">
                                <i class="fa-solid fa-chevron-right mr-2 rotate-0"></i>
                                <p class="inline">Productos</p>
                            </button>

                            <div x-show="submenu" @click.outside="submenu = false"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform translate-y-[-20px]" class="mt-4"
                                style="display: none">
                                <ul class="space-y-6 text-xs pl-5 list-disc ml-2">

                                    <li>
                                        <a href="{{route('productos')}}">Todos los productos</a>
                                    </li>

                                    <li>
                                        <a href="{{route('producto', ['producto' => 'laboratorio'])}}">Laboratorio</a>
                                    </li>

                                    <li>
                                        <a href="{{route('producto', ['producto' => 'ingresos'])}}">Ingresos</a>
                                    </li>

                                    <li>
                                        <a href="{{route('producto', ['producto' => 'medical-view-system'])}}">Medical
                                            View
                                            System</a>
                                    </li>

                                    <li>
                                        <a href="{{route('producto', ['producto' => 'odontologia'])}}">Odontología</a>
                                    </li>

                                    <li>
                                        <a href="{{route('producto', ['producto' => 'nutricion'])}}">Nutrición</a>
                                    </li>

                                    <li>
                                        <a href="{{route('producto', ['producto' => 'ginecologia'])}}">Ginecología</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </ul>
                </div>
            </div>





            <div class="flex items-center gap-4">
                <div class="flex gap-2">
                    <button onclick="translateToEnglish()"
                        class="rounded p-3 bg-[#213f8b] hover:bg-slate-300 transition-colors duration-500">
                        <picture>
                            <source srcset="{{asset('images/usa.webp')}}" type="image/webp">
                            <img src="{{asset('images/usa.png')}}" alt="USA image">
                        </picture>
                    </button>

                    <div id="google_translate_element" style="display: none;"></div>

                    <button onclick="window.location.reload()"
                        class="rounded p-3 bg-[#213f8b] hover:bg-slate-300 transition-colors duration-500">
                        <picture>
                            <source srcset="{{asset('images/mexico.webp')}}" type="image/webp">
                            <img src="{{asset('images/mexico.png')}}" alt="México image">
                        </picture>
                    </button>
                </div>

                <a class="hidden lg:block text-white uppercase bg-[#0144E8] hover:bg-[#0101e8c8] transition-colors duration-500 p-3 lg:px-7 rounded-lg"
                    href="{{route('login')}}">
                    Iniciar Sesión
                </a>
            </div>
        </nav>

        @unless(request()->routeIs('home'))
        <div class="py-8 xl:py-0 xl:h-80 flex flex-col justify-center items-center gap-3">
            <h1 class="text-3xl xl:text-6xl text-white uppercase">{{session('title')}}</h1>
            <p class="text-3xl xl:text-6xl text-white uppercase">{{session('subtitle')}}</p>
        </div>
        @endunless
    </header>
</div>