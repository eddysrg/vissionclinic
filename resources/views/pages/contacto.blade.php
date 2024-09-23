@extends('home.index')

@section('content')
<div class="w-full h-full">
    <div class="w-3/4 mx-auto py-20">
        <div class="grid lg:grid-cols-2 items-center">
            <div class="grid gap-y-8 bg-[#0A125E] p-8">
                <div class="flex items-center gap-5 border border-zinc-200 p-6">
                    <i class="fa-solid fa-location-dot text-5xl text-[#0144E8]"></i>
                    <div>
                        <h2 class="text-xl font-semibold text-[#0144E8]">Dirección</h2>
                        <p class="text-white">
                            Periférico Sur 4225, Piso 3 Col. Jardines en la Montaña C.P. 14210, México. CDMX.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-5 border border-zinc-200 p-6">
                    <i class="fa-solid fa-phone text-4xl text-[#0144E8]"></i>
                    <div>
                        <h2 class="text-xl font-semibold text-[#0144E8]">Teléfono</h2>
                        <p class="text-white">
                            55 5449 6250
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-5 border border-zinc-200 p-6">
                    <i class="fa-solid fa-envelope text-4xl text-[#0144E8]"></i>
                    <div>
                        <h2 class="text-xl font-semibold text-[#0144E8]">Email</h2>
                        <p class="text-white">
                            vissionclinic.ece@gdc-cala.com.mx
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-[#0144E8] p-8 h-full">
                <form action="" class="grid gap-y-5">
                    <div class="flex flex-col gap-2">
                        <label class="text-white font-semibold" for="name">Nombre completo</label>
                        <input class="bg-transparent placeholder-white border border-zinc-200 text-white" id="name"
                            name="name" type="text" placeholder="Introduce tu nombre" autocomplete="on">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-white font-semibold" for="email">Correo electrónico</label>
                        <input class="bg-transparent placeholder-white border border-zinc-200 text-white" id="email"
                            name="email" type="email" placeholder="Introduce tu correo electrónico" autocomplete="on">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-white font-semibold" for="message">Mensaje</label>
                        <textarea class="bg-transparent placeholder-white border border-zinc-200 text-white"
                            name="message" id="message" placeholder="Introduce un mensaje"></textarea>
                    </div>

                    <input class="bg-[#0A125E] text-white py-4 rounded-lg" type="submit" value="Enviar">
                </form>
            </div>
        </div>

    </div>
</div>
@endsection