<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, HereditaryFamilyBackground};

new
#[Layout('layouts.record')] 
#[Title('Antecedentes Heredofamiliares - Vission Clinic ECE')]
class extends Component {

    public $patient;
    public $id;

    public $observations;
    public $sectionId;

    public $paternalFamilyData = [
        ['relative' => 'Abuela Paterna', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false],
        ['relative' => 'Abuelo Paterno', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false],
        ['relative' => 'Padre', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false],
        ['relative' => 'Otro Paterno', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false]
    ];

    public $maternalFamilyData = [
        ['relative' => 'Abuela Materna', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false],
        ['relative' => 'Abuelo Materna', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false],
        ['relative' => 'Madre', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false],
        ['relative' => 'Otro Materna', 'deceased' => false, 'hta' => false, 'dm' => false, 'neoplasms' => false, 'cardiopathies' => false, 'ophthalmological' => false, 'psychiatric' => false, 'neurological' => false, 'other' => false]
    ];



    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->authorize('viewRecord', $this->patient);
        $this->id = $id;
        $this->sectionId = Patient::find($this->patient['id'])->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;

        $hereditaryFamilyBackground = HereditaryFamilyBackground::where('medical_record_sections_id', $this->sectionId)->first() ?? '';

        if($hereditaryFamilyBackground) {
            $this->paternalFamilyData = json_decode($hereditaryFamilyBackground->paternal_family_data, true);
            $this->maternalFamilyData = json_decode($hereditaryFamilyBackground->maternal_family_data, true);
            $this->observations = $hereditaryFamilyBackground->observations;
        }
    }
}; ?>

<div>
    <x-slot:id>
        {{$id}}
    </x-slot>

    <x-notification/>

    <h2 class="text-3xl text-[#174075]">Antecedentes Heredofamiliares</h2>

    <form wire:submit='save'>
        <div>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="uppercase font-normal text-sm py-8">Maternos</th>
                        <th class="uppercase font-normal text-sm py-8">Finado</th>
                        <th class="uppercase font-normal text-sm py-8">HTA</th>
                        <th class="uppercase font-normal text-sm py-8">DM</th>
                        <th class="uppercase font-normal text-sm py-8">Neoplasias</th>
                        <th class="uppercase font-normal text-sm py-8">Cardiopatías</th>
                        <th class="uppercase font-normal text-sm py-8">Oftalmológicas</th>
                        <th class="uppercase font-normal text-sm py-8">Psiquiátricas</th>
                        <th class="uppercase font-normal text-sm py-8">Neurológicas</th>
                        <th class="uppercase font-normal text-sm py-8">Otro</th>
                    </tr>
                </thead>
    
                <tbody class="text-center">
                    @foreach ($maternalFamilyData as $index => $row)
                    <tr>
                        <td class="uppercase font-normal">{{explode(' ', $row['relative'])[0]}}</td>
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-deceased-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.deceased'>
                                <label for="check-deceased-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-hta-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.hta'>
                                <label for="check-hta-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-dm-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.dm'>
                                <label for="check-dm-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-neoplasms-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.neoplasms'>
                                <label for="check-neoplasms-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-cardiopathies-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.cardiopathies'>
                                <label for="check-cardiopathies-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-ophthalmological-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.ophthalmological'>
                                <label for="check-ophthalmological-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-psychiatric-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.psychiatric'>
                                <label for="check-psychiatric-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-neurological-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.neurological'>
                                <label for="check-neurological-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-other-{{$index}}" type="checkbox"
                                    wire:model='maternalFamilyData.{{$index}}.other'>
                                <label for="check-other-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                    </tr>
                    @endforeach
                </tbody>
    
            </table>
        </div>
    
        <div class="mt-5">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="uppercase font-normal text-sm py-8">Paternos</th>
                        <th class="uppercase font-normal text-sm py-8">Finado</th>
                        <th class="uppercase font-normal text-sm py-8">HTA</th>
                        <th class="uppercase font-normal text-sm py-8">DM</th>
                        <th class="uppercase font-normal text-sm py-8">Neoplasias</th>
                        <th class="uppercase font-normal text-sm py-8">Cardiopatías</th>
                        <th class="uppercase font-normal text-sm py-8">Oftalmológicas</th>
                        <th class="uppercase font-normal text-sm py-8">Psiquiátricas</th>
                        <th class="uppercase font-normal text-sm py-8">Neurológicas</th>
                        <th class="uppercase font-normal text-sm py-8">Otro</th>
                    </tr>
                </thead>
    
                <tbody class="text-center">
                    @foreach ($paternalFamilyData as $index => $row)
                    <tr>
                        <td class="uppercase font-normal">{{explode(' ', $row['relative'])[0]}}</td>
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-deceased-{{$index}}-{{$index}}"
                                    type="checkbox" wire:model='paternalFamilyData.{{$index}}.deceased'>
                                <label for="check-deceased-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-hta-{{$index}}-{{$index}}" type="checkbox"
                                    wire:model='paternalFamilyData.{{$index}}.hta'>
                                <label for="check-hta-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-dm-{{$index}}-{{$index}}" type="checkbox"
                                    wire:model='paternalFamilyData.{{$index}}.dm'>
                                <label for="check-dm-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-neoplasms-{{$index}}-{{$index}}"
                                    type="checkbox" wire:model='paternalFamilyData.{{$index}}.neoplasms'>
                                <label for="check-neoplasms-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-cardiopathies-{{$index}}-{{$index}}"
                                    type="checkbox" wire:model='paternalFamilyData.{{$index}}.cardiopathies'>
                                <label for="check-cardiopathies-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-ophthalmological-{{$index}}-{{$index}}"
                                    type="checkbox" wire:model='paternalFamilyData.{{$index}}.ophthalmological'>
                                <label for="check-ophthalmological-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-psychiatric-{{$index}}-{{$index}}"
                                    type="checkbox" wire:model='paternalFamilyData.{{$index}}.psychiatric'>
                                <label for="check-psychiatric-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-neurological-{{$index}}-{{$index}}"
                                    type="checkbox" wire:model='paternalFamilyData.{{$index}}.neurological'>
                                <label for="check-neurological-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
    
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-other-{{$index}}-{{$index}}" type="checkbox"
                                    wire:model='paternalFamilyData.{{$index}}.other'>
                                <label for="check-other-{{$index}}-{{$index}}" class="customLabel"></label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
    
            </table>
        </div>
    
        <div class="flex justify-between gap-5 items-end">
            <div class="flex flex-col mt-5">
                <label for="observations" class="uppercase text-sm">Observaciones</label>
                <textarea wire:model='observations' name="observations" id="observations" cols="60" rows="3"
                    class="w-fit"></textarea>
                @error('observations')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="flex gap-3">
                <button wire:click.prevent='previous' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Anterior
                </button>
    
                <button wire:click.prevent='next' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Siguiente
                </button>
    
                <button wire:click='save' class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>
            </div>
        </div>
    </form>

</div>

@script
<script>
    $wire.on('previous-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/identification-form';
        }, 2000);
    });

    $wire.on('next-section', () => {
        setTimeout(() => {
            window.location.href = '/dashboard/expedientes/{{$patient['id']}}/medical-record/pathological-history';
        }, 2000);
    });
</script>
@endscript