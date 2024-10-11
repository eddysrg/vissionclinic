<x-guest-layout>

    <x-slot name="meta">
        <title>Ingresos | Vission Clinic ECE</title>
        <meta name="description" content="Modulo de ingresos de Vission Clinic ECE.">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

    <div>
        <div class="grid grid-cols-1">
            <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
                <img class="h-full w-full object-cover object-[center]" src="{{asset('images/product-ingresos.jpeg')}}"
                    alt="Banner Inicio Imagen">
            </div>


            <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
        </div>

        <div class="px-8 md:px-20 py-20">
            <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Ingresos</h2>

            <div class="space-y-5 mb-10">
                <p>
                    Toda la información clínica de tus pacientes organizada y disponible con una búsqueda simple,
                    disminuyendo el tiempo de espera de los pacientes en los consultorios o clínicas.
                </p>
            </div>

            <ul class="space-y-2">
                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Registro y edición de pacientes
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Datos Generales
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Domicilio de residencia y datos de contacto
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Ágil, eficiente, seguro
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Acceso a la información desde cualquier lugar
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Control de accesos y seguridad
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Atención médica oportuna y eficaz
                </li>
            </ul>

            <p class="mt-10">Ten acceso inmediato a la información, de manera ordenada y estructurada.</p>
        </div>

    </div>
</x-guest-layout>