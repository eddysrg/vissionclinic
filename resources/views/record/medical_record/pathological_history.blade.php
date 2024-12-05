@extends('record.record')

@section('content')
<h2 class="text-3xl text-[#174075]">Antecedentes Patológicos</h2>

<article class="grid grid-cols-2 gap-5 mt-10">
    <section>

        <div class="grid grid-cols-3 gap-2">
            <h4 class="text-[#41759D]">Exantemáticas</h4>
            <h4 class="justify-self-center">Aplica</h4>
            <h4 class="justify-self-center">Observaciones</h4>

            <p>Varicela</p>
            <x-toggle-btn name="varicela" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Rubeola</p>
            <x-toggle-btn name="rubeola" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Sarampión</p>
            <x-toggle-btn name="sarampion" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Escarlatina</p>
            <x-toggle-btn name="escarlatina" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Exantema súbito</p>
            <x-toggle-btn name="exantema-subito" />
            <input type="text" class="py-1 rounded border-zinc-300">
        </div>

        <div class="flex items-center gap-10 mt-8">
            <h4 class="text-[#41759D]">Parasitarias</h4>
            <input type="text" class="py-1 rounded border-zinc-300">
        </div>

        <div class="grid grid-cols-3 gap-2 mt-8">
            <h4 class="text-[#41759D] col-span-3">Enfermedad crónica degenerativas</h4>

            <p>Obesidad</p>
            <x-toggle-btn name="obesidad" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Diabetes Mellitus</p>
            <x-toggle-btn name="diabetes" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Hipertensión arterial</p>
            <x-toggle-btn name="hipertension" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Dislipidemia</p>
            <x-toggle-btn name="dislipidemia" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Neoplasias</p>
            <x-toggle-btn name="neoplasias" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Neurológicas</p>
            <x-toggle-btn name="neurologicas" />
            <input type="text" class="py-1 rounded border-zinc-300">

            <p>Otras</p>
            <input type="text" class="py-1 rounded border-zinc-300 col-span-2">
        </div>

    </section>

    <section>
        <h4 class="text-[#41759D] mb-2">Traumáticos</h4>

        <div class="flex gap-3">
            <p>Fecha</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <input type="text" class="py-1 rounded border-zinc-300" placeholder="Observaciones">
        </div>

        <h4 class="text-[#41759D] mt-5">Fracturas</h4>

        <div class="flex flex-wrap gap-3">
            <p>Fecha</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <p>Tipo</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <input type="text" class="py-1 rounded border-zinc-300" placeholder="Observaciones">
        </div>

        <h4 class="text-[#41759D] mt-5">Alérgicos</h4>
        <textarea name="" id="" cols="30" rows="3" class="rounded border-zinc-300"></textarea>

        <h4 class="text-[#41759D] mt-5">Quirúrgicos</h4>
        <div class="flex flex-wrap gap-3">
            <p>Fecha</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <p>Tipo</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <input type="text" class="py-1  w-full rounded border-zinc-300"
                placeholder="Presencia o no de complicaciones">
        </div>

        <h4 class="text-[#41759D] mt-5">Hospitalizaciones previas</h4>
        <div class="flex flex-wrap gap-3">
            <p>Fecha</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <p>Motivo de ingreso</p>
            <input type="text" class="py-1 rounded border-zinc-300">
        </div>

        <h4 class="text-[#41759D] mt-5">Hospitalizaciones previas</h4>
        <div class="flex flex-wrap gap-3">
            <p>Fecha</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <p>Tipo de componente</p>
            <input type="text" class="py-1 rounded border-zinc-300">
            <p>Motivo de ingreso</p>
            <input type="text" class="py-1 rounded border-zinc-300">
        </div>
    </section>
</article>

<div class="flex justify-end gap-3 mt-10">
    <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
        Anterior
    </button>

    <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
        Siguiente
    </button>

    <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
        Guardar
    </button>
</div>

@endsection