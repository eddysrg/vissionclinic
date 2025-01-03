<fieldset class="mb-4 mt-10">
    <legend class="text-[#174075] text-xl mb-4">Diagnóstico de enfermedades (CIE10)</legend>

        

    <div class="flex justify-end">
        <button x-on:click.prevent="$dispatch('open-modal', 'addDiagnosis')" class="bg-[#41759D] text-white py-2 px-3 rounded text-xs">+ Agregar Diagnostico</button>
    </div>

    

    <x-modal name="addDiagnosis" maxWidth="3xl">
        <section>
            <label for="procedureSearch" class="block font-semibold">Nombre del procedimiento o código CIE-10</label>
            <div class="flex items-center gap-3">
                <input wire:model='searchInput' type="text" id="procedureSearch" class="rounded border-zinc-400 py-1 flex-1">
                <button wire:click.prevent='search' class="bg-[#41759D] py-2 px-5 rounded text-white text-xs">Buscar diagnóstico</button>
            </div>
    
            <table class="dod-table mt-5">
                <thead>
                    <tr>
                        <th class="text-sm">Clave</th>
                        <th class="text-sm">Nombre de la enfermedad</th>
                        <th class="text-sm">Caso nuevo</th>
                        <th class="text-sm">Estúdio</th>
                    </tr>
                </thead>
                <tbody>
    
                    @forelse ($results as $result)
                        <tr>
                            <td>
                                <button wire:click.prevent='addDiagnosis({{$result->id}})'>
                                    {{$result->catalog_key}}
                                </button>
                                
                            </td>
                            <td>
                                <button>
                                    {{$result->name}}
                                </button>
                            </td>
                            <td>
                                <section class="flex gap-5">
                                    <div class="flex items-center gap-2">
                                        <label for="{{$result->catalog_key}}_yes">Si</label>
                                        <input wire:model='newCase.{{$result->id}}' type="radio" id="{{$result->catalog_key}}_yes" name="{{$result->name}}" value="Si">
                                    </div>
    
                                    <div class="flex items-center gap-2">
                                        <label for="{{$result->catalog_key}}_no">No</label>
                                        <input wire:model='newCase.{{$result->id}}' type="radio" id="{{$result->catalog_key}}_no" name="{{$result->name}}" value="No">
                                    </div>
                                </section>
                            </td>
                            <td>{{$result->require_epi_study}}</td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </section>
    </x-modal>


    <table class="dod-table mt-5">
        <thead>
            <tr>
                <th class="text-sm">Código</th>
                <th class="w-2/4 text-sm">Enfermedad</th>
                <th class="text-xs">Formulario</th>
                <th class="text-xs">Caso nuevo</th>
                <th class="text-xs">¿Estudio?</th>
                <th class="text-xs">Estatus</th>
                <th class="text-xs">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($selectedDiagnoses as $diagnosis)
                <tr>
                    <td>{{$diagnosis['catalog_key']}}</td>
                    <td>{{$diagnosis['name']}}</td>
                    <td>{{$diagnosis['form']}}</td>
                    <td>{{$diagnosis['newCase']}}</td>
                    <td>{{$diagnosis['study']}}</td>
                    <td>{{$diagnosis['status']}}</td>
                    <td>
                        <button wire:click.prevent='removeDiagnosis({{$diagnosis['id']}})' wire:confirm='¿Estás seguro de eliminar este diagnóstico?'>
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>

</fieldset>

@script
<script>
    $wire.on('validationFailed', () => {
        alert('Debe indicar si el padecimiento es nuevo o no');
    });
</script>
@endscript