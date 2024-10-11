<x-guest-layout>

    <x-slot name="meta">
        <title>Productos | Vission Clinic</title>
        <meta name="description" content="Conoce nuestra suite de productos">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

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

            @foreach ($producto as $item)
            <x-product-cell :name="$item" />
            @endforeach
        </div>
    </div>
</x-guest-layout>