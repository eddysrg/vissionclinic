@extends('record.record')

@section('content')
<h2 class="text-3xl text-[#174075]">Antecedentes No Patológicos</h2>

<article class="grid grid-cols-2 gap-5 mt-10">
    <section>

        <div class="flex items-center gap-3">
            <p>Tipo de sangre</p>
            <select class="py-1 rounded border-zinc-300">
            </select>

            <select class="py-1 rounded border-zinc-300" name="" id="">
                <option value="">Positivo</option>
            </select>

            <select class="py-1 rounded border-zinc-300" name="" id="">
                <option value="">Verificado</option>
            </select>
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Alimentación/Dieta</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="alimentacion-mala" />
                <p>Mala</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="alimentacion-regular" />
                <p>Regular</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="alimentacion-buena" />
                <p>Buena</p>
            </div>
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Actividad Física</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="actividad-fisica-mala" />
                <p>Mala</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="actividad-fisica-regular" />
                <p>Regular</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="actividad-fisica-buena" />
                <p>Buena</p>
            </div>
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Higiene</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="higiene-mala" />
                <p>Mala</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="higiene-regular" />
                <p>Regular</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="higiene-buena" />
                <p>Buena</p>
            </div>
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Tabaco</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="tabaco-si" />
                <p>Si</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="tabaco-no" />
                <p>no</p>
            </div>
            <div class="flex items-center gap-2">
                <p>Ex-fumador</p>
                <input type="radio" class="border-none bg-gray-300">
            </div>
        </div>

        <div class="mt-2">
            <input type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Alcohol</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="alcohol-si" />
                <p>Si</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="alcohol-no" />
                <p>no</p>
            </div>
            <div class="flex items-center gap-2">
                <p>Ex-alcoholico</p>
                <input type="radio" class="border-none bg-gray-300">
            </div>
        </div>

        <div class="mt-2">
            <input type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Toxicomanías</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="toxicomanias-si" />
                <p>Si</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="toxicomanias-no" />
                <p>no</p>
            </div>
            <div class="flex items-center gap-2">
                <p>Ex-adicto</p>
                <input type="radio" class="border-none bg-gray-300">
            </div>
        </div>

        <div class="mt-2">
            <input type="text" class="py-1 rounded border-zinc-300 w-full" placeholder="Observaciones">
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Tipo de vivienda</h4>
            <input type="text" class="py-1 rounded border-zinc-300 w-full">
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Zona Geográfica</h4>
            <select class="py-1 rounded border-zinc-300 w-full">
            </select>
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Nivel Socioeconómico</h4>
            <select class="py-1 rounded border-zinc-300 w-full">
            </select>
        </div>

        <div class="flex gap-5 mt-8">
            <h4>Servicios</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="servicios-luz" />
                <p>Luz</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="servicios-agua" />
                <p>Agua</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="servicios-drenaje" />
                <p>Drenaje</p>
            </div>
        </div>

        <div class="flex items-center gap-5 mt-8">
            <h4>Fauna</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="fauna-si" />
                <p>Si</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="fauna-no" />
                <p>No</p>
            </div>
            <div>
                <input type="text" class="border-zinc-300 py-1" placeholder="Observaciones">
            </div>
        </div>

        <div class="flex items-center gap-5 mt-8">
            <h4>Promiscuidad</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="promiscuidad-si" />
                <p>Si</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="promiscuidad-no" />
                <p>No</p>
            </div>
            <div>
                <input type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
            </div>
        </div>

        <div class="flex items-center gap-5 mt-8">
            <h4>Hacinamiento</h4>
            <div class="flex gap-2">
                <x-toggle-btn name="hacinamiento-si" />
                <p>Si</p>
            </div>
            <div class="flex gap-2">
                <x-toggle-btn name="hacinamiento-no" />
                <p>No</p>
            </div>
            <div>
                <input type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
            </div>
        </div>

        <div class="flex items-center gap-5 mt-8">
            <h4>Inmunizaciones</h4>

            <select name="" id="" class="border-zinc-300 py-1 rounded">
                <option value="">Completas</option>
            </select>

            <input type="text" class="border-zinc-300 py-1 rounded" placeholder="Observaciones">
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