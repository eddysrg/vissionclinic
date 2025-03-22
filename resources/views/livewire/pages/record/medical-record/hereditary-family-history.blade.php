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

    public $paternalFamilyData = [];
    public $maternalFamilyData = [];

    protected function initializeFamilyData($relativeType, $relatives)
    {
        return array_map(function ($relative) {
            return [
                'relative' => $relative,
                'deceased' => false,
                'hta' => false,
                'dm' => false,
                'neoplasms' => false,
                'cardiopathies' => false,
                'ophthalmological' => false,
                'psychiatric' => false,
                'neurological' => false,
                'other' => false
            ];
        }, $relatives);
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->authorize('viewRecord', $this->patient);
        $this->id = $id;
        $this->sectionId = $this->patient->record->medicalRecordSections->where('name', 'clinic_history')->first()->id;

        $hereditaryFamilyBackground = HereditaryFamilyBackground::where('medical_record_sections_id', $this->sectionId)->first();

        $this->paternalFamilyData = $this->initializeFamilyData('paternal', ['Abuela Paterna', 'Abuelo Paterno', 'Padre', 'Otro Paterno']);
        $this->maternalFamilyData = $this->initializeFamilyData('maternal', ['Abuela Materna', 'Abuelo Materno', 'Madre', 'Otro Materno']);

        if ($hereditaryFamilyBackground) {
            $this->paternalFamilyData = json_decode($hereditaryFamilyBackground->paternal_family_data, true) ?? $this->paternalFamilyData;
            $this->maternalFamilyData = json_decode($hereditaryFamilyBackground->maternal_family_data, true) ?? $this->maternalFamilyData;
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
        @foreach (['maternal' => $maternalFamilyData, 'paternal' => $paternalFamilyData] as $type => $familyData)
        <div class="mt-5">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="uppercase font-normal text-sm py-8">{{ ucfirst($type) }}es</th>
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
                    @foreach ($familyData as $index => $row)
                    <tr>
                        <td class="uppercase font-normal">{{ explode(' ', $row['relative'])[0] }}</td>
                        @foreach (['deceased', 'hta', 'dm', 'neoplasms', 'cardiopathies', 'ophthalmological', 'psychiatric', 'neurological', 'other'] as $field)
                        <td>
                            <div class="checkbox-container">
                                <input class="checkbox-historyForm" id="check-{{ $field }}-{{ $type }}-{{ $index }}" type="checkbox"
                                    wire:model='{{ $type }}FamilyData.{{ $index }}.{{ $field }}'>
                                <label for="check-{{ $field }}-{{ $type }}-{{ $index }}" class="customLabel"></label>
                            </div>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    
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