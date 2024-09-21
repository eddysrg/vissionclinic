<footer class="bg-[#0A125E] text-white px-8 md:px-20 py-10">
    <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-20">
        <section>
            <div class="relative">
                <h2 class="text-2xl mb-8"><span class="text-[#0144E8]">Vission</span> Clinic</h2>
                <div class="absolute w-20 h-1 bg-white bottom-[-12px]"></div>
            </div>

            <p>
                Somos una empresa 100% Mexicana dedicada a brindar servicios de
                Administración Hospitalaria.
            </p>
        </section>

        <section>
            <div class="relative">
                <h2 class="text-2xl mb-8 text-[#0144E8]">Contacto</h2>
                <div class="absolute w-20 h-1 bg-white bottom-[-12px]"></div>
            </div>

            <div class="space-y-5">
                <div>
                    <h4 class="text-[#0144E8]">Dirección:</h4>
                    <p>Periférico Sur 4225, Piso 3 Col. Jardines en la Montaña C.P. 14210, México. CDMX.</p>
                </div>

                <div>
                    <h4 class="text-[#0144E8]">Teléfono:</h4>
                    <p>55 5449 6250</p>
                </div>
            </div>
        </section>

        <section>
            <div class="relative">
                <h2 class="text-2xl mb-8 text-[#0144E8]">Menú</h2>
                <div class="absolute w-20 h-1 bg-white bottom-[-12px]"></div>
            </div>

            <nav>
                <ul class="text-white space-y-2">
                    <li class="uppercase flex items-center gap-2 hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-1"></i>
                        <a href="{{route('home')}}">Inicio</a>
                    </li>

                    <li class="uppercase flex items-center gap-2 hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-1"></i>
                        <a href="{{route('healthcare', ['nivel' => 'nivel-uno'])}}">Exp. Clínico</a>
                    </li>

                    <li class="uppercase flex items-center gap-2 hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-1"></i>
                        <a href="{{route('mvs')}}">Medical View System</a>
                    </li>

                    <li class="uppercase flex items-center gap-2 hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-1"></i>
                        <a href="{{route('lyrium')}}">Lyrium</a>
                    </li>

                    <li class="uppercase flex items-center gap-2 hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-1"></i>
                        <a href="{{route('productos')}}">Productos</a>
                    </li>

                    <li class="uppercase flex items-center gap-2 hover:text-[#0144E8] duration-300">
                        <i class="fa-solid fa-chevron-right mr-1"></i>
                        <a href="#">Contacto</a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>

    <div class="mt-12 flex items-end justify-between">
        <legend class="text-xs md:text-base font-light">© VissionClinic. Todos los derechos reservados.</legend>

        <div class="w-20 md:w-40">
            <x-white-logo />
        </div>
    </div>

</footer>