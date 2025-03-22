<?php

use Livewire\Volt\Component;
use App\Models\Patient;
use Livewire\Attributes\{Layout, Title, On};
use App\Livewire\Forms\FamilyHistoryForm;
use Illuminate\View\View;


new
#[Layout('components.layout.record')]
#[Title('Antecedentes Heredofamilares - Vission Clinic ECE')]
class extends Component
{
    public $patient;
    public FamilyHistoryForm $form;

    protected function initializeFamilyData($relativeType, $relatives): array
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

    public function previous()
    {
        $this->form->store();
        $route = route('dashboard.record.identification-form', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Datos guardados correctamente', link: $route);
    }

    public function next()
    {
        $this->form->store();
        $route = route('dashboard.record.pathological-history', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Datos guardados correctamente', link: $route);
    }

    public function save(): void
    {
        $this->form->store();
        $route = route('dashboard.record.family-history', ['id' => $this->patient->id]);
        $this->dispatch('show-noti', message: 'Datos guardados correctamente', link: $route);
    }

    public function mount($id): void
    {
        $this->patient = Patient::findOrFail($id);
        $this->form->paternosFamilyData = $this->initializeFamilyData('paternal', ['Abuela Paterna', 'Abuelo Paterno', 'Padre', 'Otro Paterno']);
        $this->form->maternosFamilyData = $this->initializeFamilyData('maternal', ['Abuela Materna', 'Abuelo Materno', 'Madre', 'Otro Materno']);

        $this->form->medicalRecordId = $this->patient->load('record.medicalRecord')->record->medicalRecord->id;
        $this->form->setFamilyHistoryData();
    }

    public function rendering(View $view)
    {
        $view
            ->layout('components.layout.record', [
                'patient' => $this->patient,
                'hasAppointment' => !$this->patient->appointments->isEmpty(),
            ]);
    }
}; ?>

<x-slot:patientID>
    {{$this->patient->id}}
</x-slot>


<div>
    <x-record-notification/>

    <h2 class="text-3xl text-[#174075]">Antecedentes Heredofamiliares</h2>

    <form wire:submit='save'>
        @foreach (['maternos' => $form->maternosFamilyData, 'paternos' => $form->paternosFamilyData] as $type => $familyData)
            <div class="mt-5">
                <table class="w-full border-collapse">
                    <thead>
                    <tr>
                        <th class="uppercase font-normal text-sm py-8">{{ ucfirst($type) }}</th>
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
                                        <input class="checkbox-historyForm"
                                               id="check-{{ $field }}-{{ $type }}-{{ $index }}" type="checkbox"
                                               wire:model='form.{{ $type }}FamilyData.{{ $index }}.{{ $field }}'>
                                        <label for="check-{{ $field }}-{{ $type }}-{{ $index }}"
                                               class="customLabel"></label>
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
                <textarea wire:model='form.observations' name="observations" id="observations" cols="60" rows="3"
                          class="w-fit"></textarea>
                @error('observations')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-3">
                <button wire:click.prevent='previous'
                        class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Anterior
                </button>

                <button wire:click.prevent='next'
                        class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Siguiente
                </button>

                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>
            </div>
        </div>
    </form>
</div>
