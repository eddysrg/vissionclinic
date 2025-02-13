<?php
use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};

new 
#[Layout('layouts.website')] 
#[Title('ECE Nivel 1 - VissionClinic')]
class extends Component {
    //
}; ?>

<x-slot:meta_description>
    El Expediente Clínico Electrónico es el producto perfecto para brindar una mejor atención y servicio a los pacientes, utilizando la modernización de los procesos de los servicios de salud.
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
        <p class="text-3xl xl:text-6xl text-white uppercase">NIVEL 1</p>
    </div>

    <div class="grid md:flex md:justify-center md:items-center gap-5 py-8">
        <div class="px-8">
            <picture>
                <source srcset="{{asset('images/nivel1-main.webp')}}" type="image/webp">
                <img src="{{asset('images/nivel1-main.png')}}" alt="Image nivel 1">
            </picture>
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

    <div class="md:flex md:justify-center px-8 md:px-0 py-8 md:py-10">
        <picture>
            <source srcset="{{asset('images/nivel1-bloque2.webp')}}" type="image/webp">
            <img src="{{asset('images/nivel1-bloque2.png')}}" alt="Nivel 1 bloque 2">
        </picture>
    </div>

    <div class="py-8 md:pt-0">
        <h2 class="md:mt-8 mb-10 text-4xl text-[#0A125E] text-center">Perfiles</h2>

        <div class="flex md:justify-center md:gap-3">
            <div class="bg-[#0144E8] w-2/4 max-w-56 md:max-w-64 h-56 mx-auto md:mx-0 p-5">
                <div class="bg-[#0A125E] w-12 h-12 aspect-square rounded-full flex justify-center items-center">
                    <img class="p-2" src="{{asset('images/medico-icon.png')}}" alt="Medico Icon">
                </div>

                <p class="text-white text-2xl text-center py-8 font-medium">Médico General</p>
            </div>

            <div class="hidden md:block bg-[#0144E8] w-2/4 max-w-56 md:max-w-64 h-56 mx-auto md:mx-0 p-5">
                <div class="bg-[#0A125E] w-12 h-12 aspect-square rounded-full flex justify-center items-center">
                    <img class="p-2" src="{{asset('images/medico-icon.png')}}" alt="Medico Icon">
                </div>

                <p class="text-white text-2xl text-center py-8 font-medium">Odontólogo</p>
            </div>

            <div class="hidden md:block bg-[#0144E8] w-2/4 max-w-56 md:max-w-64 h-56 mx-auto md:mx-0 p-5">
                <div class="bg-[#0A125E] w-12 h-12 aspect-square rounded-full flex justify-center items-center">
                    <img class="p-2" src="{{asset('images/medico-icon.png')}}" alt="Medico Icon">
                </div>

                <p class="text-white text-2xl text-center py-8 font-medium">Enfermería</p>
            </div>

            <div class="hidden md:block bg-[#0144E8] w-2/4 max-w-56 md:max-w-64 h-56 mx-auto md:mx-0 p-5">
                <div class="bg-[#0A125E] w-12 h-12 aspect-square rounded-full flex justify-center items-center">
                    <img class="p-2" src="{{asset('images/medico-icon.png')}}" alt="Medico Icon">
                </div>

                <p class="text-white text-2xl text-center py-8 font-medium">Radiólogo</p>
            </div>
        </div>
    </div>
</main>
