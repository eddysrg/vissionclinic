<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};


new 
#[Layout('layouts.website')] 
#[Title('Lyrium - VissionClinic')]
class extends Component {
    //
}; ?>

<x-slot:meta_description>
    Lyrium es el asistente de Inteligencia Avanzada ubicado en la nube.
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
        <h1 class="text-3xl xl:text-6xl text-white uppercase">Lyrium</h1>
    </div>

    <div class="w-full">
        <img class="w-full block" src="{{asset('images/lyrium_site.png')}}" alt="">
    </div>

    <div class="px-8 py-20 md:px-20 md:py-32">
        <div class="px-0 md:px-24">

            <p class="text-[#091E3E] leading-normal text-lg md:text-xl">
                Lyrium es el asistente de Inteligencia Avanzada ubicado en la nube, a través de el, creamos una nueva
                experiencia
                para ofrecer a los clientes una forma más intuitiva de interactuar con las herramientas que su empresa
                necesita.
            </p>

            <h2 class="mt-20 mb-10 text-4xl text-[#0A125E] text-center">Conoce nuestra suite</h2>

            <div>
                <img src="{{asset('images/lyrium_main_image.png')}}" alt="Lyrium Image">
            </div>
        </div>
    </div>
</main>
