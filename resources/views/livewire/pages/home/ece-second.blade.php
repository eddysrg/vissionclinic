<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};


new 
#[Layout('layouts.website')] 
#[Title('ECE Nivel 2 - VissionClinic')]
class extends Component {
    //
}; ?>

<x-slot:meta_description>
    Esta dirigido a clínicas, centro de salud, hospitales y a todo el sector salud con las especialidades y servicios que cuenta Vission Clinic.
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
        <h1 class="text-3xl xl:text-6xl text-white uppercase">Vission Clinic ECE</h1>
        <p class="text-3xl xl:text-6xl text-white uppercase">NIVEL 2</p>
    </div>
    
    <div class="grid md:flex md:flex-row-reverse md:justify-center md:items-center gap-5 py-8">
        <div class="px-8">
            <img src="{{asset('images/main-nivel2.png')}}" alt="Image nivel 2">
        </div>

        <div class="bg-[#0144E8] text-white p-3 md:w-1/3">
            <h2 class="text-xl uppercase mb-5">¿Qué es un expediente clínico electrónico?</h2>
            <p>
                Es un conjunto de información almacenada en medios electrónicos que permite resolver problemas de la
                práctica médica diaria, con arreglo a las disposiciones sanitarias, dentro de un establecimiento de
                salud.
                El expediente clínico electrónico tiene como finalidad llevar un control histórico-clínico del paciente
                de
                manera ordenada, donde los principales usuarios son médicos, enfermeras y el personal de salud
                previamente
                autorizado que esté involucrado en la atención y servicio otorgado al derechohabiente. La idea de
                implementar esta nueva modalidad en las unidades clínicas permitirá brindar una mejor atención y
                servicio a
                los pacientes, utilizando la modernización de los procesos de los servicios de salud.
            </p>

            <h2 class="text-xl uppercase mb-5 mt-4">¿A quién está orientado?</h2>
            <p>
                Esta dirigido a clínicas, centro de salud, hospitales y a todo el sector salud con las especialidades y
                servicios que cuenta Vission Clinic.
            </p>
        </div>
    </div>

    <div class="py-8 px-8 md:px-0">
        <div class="md:w-2/3 md:flex md:mx-auto md:gap-10 md:items-center">
            <div class="mb-10 md:mb-0">
                <img src="{{asset('images/imagendos_nivel2.png')}}" alt="Imagen dos nivel 2">
            </div>

            <div class="space-y-1 grow-[2]">
                <div class="text-white">
                    <p class="bg-[#0A125E] px-10 py-5 text-xl uppercase text-center">Ingresos por consulta</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0144E8] px-10 py-5 text-xl uppercase text-center">Ingresos por urgencia</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0A125E] px-10 py-5 text-xl uppercase text-center">Trabajo Social</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0144E8] px-10 py-5 text-xl uppercase text-center">Nutrición</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0A125E] px-10 py-5 text-xl uppercase text-center">Anestesiología</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0144E8] px-10 py-5 text-xl uppercase text-center">Enfermería</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-8 px-8 md:px-0">
        <div class="md:w-2/3 md:flex md:flex-row-reverse md:mx-auto md:gap-10 md:items-center">
            <div class="mb-10 md:mb-0">
                <img src="{{asset('images/imagentres_nivel3.png')}}" alt="Imagen dos nivel 2">
            </div>

            <div class="space-y-1 grow-[2]">
                <div class="text-white">
                    <p class="bg-[#0A125E] px-10 py-5 text-xl uppercase text-center">Módulo Covid</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0144E8] px-10 py-5 text-xl uppercase text-center">Medicina Interna</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0A125E] px-10 py-5 text-xl uppercase text-center">Pediatría</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0144E8] px-10 py-5 text-xl uppercase text-center">Ginecología</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0A125E] px-10 py-5 text-xl uppercase text-center">Traumatismo S.O1</p>
                </div>

                <div class="text-white">
                    <p class="bg-[#0144E8] px-10 py-5 text-xl uppercase text-center">Gestión de quirófano</p>
                </div>
            </div>
        </div>
    </div>
</main>
