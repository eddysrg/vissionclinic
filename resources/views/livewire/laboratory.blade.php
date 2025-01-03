<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <form>
        <fieldset class="mt-8 grid grid-cols-4 gap-5">
            <div class="flex flex-col">
                <label for="date" class="uppercase text-xs">Fecha</label>
                <input type="date" id="date" class="text-sm rounded border-zinc-400 py-1">
            </div>

            <div class="flex flex-col">
                <label for="time" class="uppercase text-xs">Hora</label>
                <input type="time" id="time" class="text-sm rounded border-zinc-400 py-1">
            </div>

            <div class="flex flex-col">
                <label for="urgent" class="uppercase text-xs">Servicio</label>
                <select id="service" class="text-sm rounded border-zinc-400 py-1">
                    <option value="">Selecciona una opción</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="urgent" class="uppercase text-xs">¿Urgente?</label>
                <select id="urgent" class="text-sm rounded border-zinc-400 py-1">
                    <option value="">Selecciona una opción</option>
                </select>
            </div>

            <div class="flex flex-col col-span-2">
                <label for="sampleType" class="uppercase text-xs">Tipo de muestra</label>
                <select id="sampleType" class="text-sm rounded border-zinc-400 py-1">
                    <option value="">Selecciona una opción</option>
                </select>
            </div>
        </fieldset>

        <fieldset class="mt-8">
            <legend class="text-[#174075] text-xl mb-4">Diagnóstico</legend>
            <textarea id="diagnosis" rows="4" class="w-full rounded border-zinc-400"></textarea>

            <ul>
                <li x-data="{ open: false }" class="">
                    <div @click="open = !open" class="flex gap-5 bg-[#859EB9] text-[#0E2F5E] p-3 rounded">
                        <h4>1.Hematología</h4>
                        <span>(Selecciona)</span>
                    </div>
        
                    <section 
                    x-show="open" @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-[-10px]"
                    class="p-2 bg-white" style="display: none">
                        <div>
                            <input type="radio" id="bhfr">
                            <label for="bhfr">Biometría Hemática - F.roja</label>
                        </div>
                    </section>
                </li>
            </ul>
            
        </fieldset>

        <fieldset class="mt-8">
            <legend class="text-[#174075] text-xl mb-4">Estudios especiales</legend>
            <textarea id="studies" rows="2" class="w-full rounded border-zinc-400"></textarea>
        </fieldset>

        <fieldset class="mt-8 grid grid-cols-2">
            <legend class="text-[#174075] text-xl mb-4 ">Folio físico</legend>
            <input type="text" id="physicalFolio" class="rounded border-zinc-400 w-full">
        </fieldset>

        <div class="flex items-center justify-end mt-8">
            <div class="flex gap-3">
                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Consulta médica
                </button>

                <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#41759D] text-white rounded-full flex items-center gap-2">
                    Imprimir
                </button>

                <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>

                <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Finalizar consulta
                </button>
            </div>
        </div>
    </form>
</div>
