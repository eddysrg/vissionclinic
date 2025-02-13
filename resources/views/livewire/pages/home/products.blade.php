<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\RouteName;

new
#[Layout('layouts.website')] 
#[Title('Productos - VissionClinic')]
class extends Component {
    public $productRouteNames = ['laboratorio', 'ingresos', 'medical-view-system', 'odontologia', 'nutricion', 'ginecologia'];
    public $productos;

    public function mount()
    {
        $this->productos = RouteName::whereIn('route_name', $this->productRouteNames)->get();
    }
}; ?>

<x-slot:meta_description>
    Conoce nuestra suite de productos.
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
        <h1 class="text-3xl xl:text-6xl text-white uppercase">Nuestros productos</h1>
    </div>

    <div>
        <div class="grid grid-cols-1">
            <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
                <img class="h-full w-full object-cover object-[center_top]"
                    src="{{asset('images/product-hero-main.jpeg')}}" alt="Banner Inicio Imagen">
            </div>
            <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
        </div>

        <div
            class="px-8 md:px-0 md:max-w-[81rem] md:mx-auto py-10 md:py-20 flex flex-col items-center md:grid md:grid-cols-3 gap-10 md:justify-items-center">

            {{-- @foreach ($productos as $producto)
            <x-product-cell :name="$producto" />
            @endforeach --}}
        </div>
    </div>
</main>