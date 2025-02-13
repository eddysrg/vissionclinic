<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};


new 
#[Layout('layouts.website')] 
#[Title('Odontología - VissionClinic')]
class extends Component {
    //
}; ?>

<x-slot:meta_description>
    Modulo de odontología de Vission Clinic ECE.
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
        <h1 class="text-3xl xl:text-6xl text-white uppercase">Odontología</h1>
    </div>

    <div>
        <div class="grid grid-cols-1">
            <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
                <img class="h-full w-full object-cover object-[center]"
                    src="{{asset('images/product-odontologia.jpeg')}}" alt="Banner Inicio Imagen">
            </div>


            <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
        </div>

        <div class="px-8 md:px-20 py-20">
            <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Odontología</h2>

            <div class="space-y-5 mb-10">
                <p>
                    Con nuestro software de salud Vission Clinic ECE podrás brindar un mejor servicio de agendamiento
                    dental
                    y
                    administración, tanto para clínicas, centros dentales y dentistas independientes
                    Llevarás el control de las atenciones y evoluciones de tus pacientes
                </p>

                <p>
                    Al no existir documentos físicos es posible conservar los expedientes electrónicos por un tiempo
                    indefinido y poder consultarlos en cualquier momento.
                </p>

                <p>
                    El odontograma digital de Vission Clinic ECE es sumamente sencillo de utilizar, con unos cuantos
                    clicks
                    tendrás
                    a la vista toda la información dental de tu paciente.
                </p>
            </div>
        </div>

    </div>
</main>
