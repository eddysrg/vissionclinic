<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};


new 
#[Layout('layouts.website')] 
#[Title('MVS - VissionClinic')]
class extends Component {
    //
}; ?>

<x-slot:meta_description>
    Modulo MVS de Vission Clinic ECE.
</x-slot>

<x-slot:meta_keywords>
    VissionClinic, Expediente clínico 
</x-slot>

<x-slot:meta_robots>
    index,follow
</x-slot>

<x-slot:meta_canonical>
    {{url()->current()}}
</x-slot>

<main>
    <div class="bg-[#0144E8] py-8 xl:py-0 xl:h-80 flex flex-col justify-center items-center gap-3">
        <h1 class="text-3xl xl:text-6xl text-white uppercase">Medical View System</h1>
    </div>

    <div>
        <div class="grid grid-cols-1">
            <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
                <img class="h-full w-full object-cover object-[center]"
                    src="{{asset('images/product-medical-view-system.jpeg')}}" alt="Banner Inicio Imagen">
            </div>


            <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
        </div>

        <div class="px-8 md:px-20 py-20">
            <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Medical View System</h2>

            <div class="space-y-5 mb-10">
                <p>
                    El flujo de trabajo completo de Medical View System, comienza desde la extracción de la información,
                    hasta el análisis de la misma presentada en dashboards.
                </p>

                <p>
                    El primer paso a realizar es la extracción, transformación y carga de la información. Este proceso
                    es
                    una parte de la integración de datos y aplicaciones. Una vez incluido el primer bloque, la
                    información
                    pasa a formar parte de informes que resaltan visualizaciones previas y hechos. Posteriormente se
                    definen
                    los gráficos y dashboards nescesarios para la correcta representación y análisis de la información.
                </p>
            </div>



            <ul class="space-y-8">
                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Sistema web disponible desde cualquier lugar.
                    <span class="block text-sm ml-7 mt-2">Accesos a la información en línea con perfiles de
                        usuario.</span>
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Reportes ejecutivos personalizables.
                    <span class="block text-sm ml-7 mt-2">Información en tiempo real e históricos para la generación de
                        reportes.</span>
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Graficas de barras y de pastel.
                    <span class="block text-sm ml-7 mt-2">Muestra el desempeño obtenido por cada uno de los sitios que
                        comforman la red.</span>
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Filtros que facilitan la obtención de datos clave.
                    <span class="block text-sm ml-7 mt-2">Debido a su gran variedad de filtros, el usuario puede
                        visualizar
                        la información específca por fecha, tipo de sitio, tipo de conectividad y dispositivos.</span>
                </li>
            </ul>
        </div>

    </div>
</main>
