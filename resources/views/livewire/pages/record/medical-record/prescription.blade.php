<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, Medicine, MedicalRecordSection, Prescription};
use App\Livewire\Forms\PrescriptionForm;
use Illuminate\View\View;

new
#[Title('Referencia - Vission Clinic ECE')]
class extends Component {
    public $patient;
    public PrescriptionForm $form;
    public $medicines = [];
    public $search = '';
    public $prescriptionRecords = [];

    public function save()
    {
        if(empty($this->form->medicineResults)) {
            $this->dispatch('medicine-alert', message: "Debes seleccionar un fármaco de la lista");
            return;
        }

        $this->form->store();

        $this->dispatch('show-notification', message: 'Receta registrada con éxito');

    }

    public function updatedSearch()
    {
        $this->medicines = Medicine::whereFullText('name', $this->search)->get();
    }

    public function setToMedicineList($id)
    {
        $medicineData = Medicine::find($id) ?? '';

        if($medicineData) {
            $this->form->medicineResults[] = $medicineData;
        }

        $this->search = '';
    }

    public function removeMedicine($id)
    {
        $this->form->medicineResults = array_filter($this->form->medicineResults, function($medicine) use ($id) {
            return $medicine->id !== $id;
        });
    }

    public function getPrescriptions()
    {
        $this->prescriptionRecords = MedicalRecordSection::with('prescriptions')->find($this->form->medicalRecordSectionId)->prescriptions ?? [];
        $this->dispatch('open-modal', 'list-prescription');
    }

    public function printPrescription($id)
    {

        $prescription = Prescription::find($id)->toArray();

        $pdf = Pdf::loadView('layouts.pdf.print-prescription', $prescription);

        return response()->streamDownload(
            fn () => print($pdf->output()), 'receta-medica.pdf'
        );
    }

    public function mount($id)
    {
        $this->patient = Patient::find($id);

        // Setting the date and time
        $this->form->date = now()->format('Y-m-d');
        $this->form->time = now()->format('H:i');
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

<div
    x-on:medicine-alert.window="alert($event.detail.message)" >


    <x-record-notification/>

    {{-- Start of component --}}

    <h2 class="text-3xl text-[#174075]">Recetario</h2>

    <form wire:submit.prevent='save'>
        <fieldset class="grid grid-cols-3 gap-5">
            <div class="flex flex-col">
                <label class="text-xs" for="date" class="uppercase">Fecha</label>
                <input wire:model='form.date' type="date" id="date" class="text-sm rounded border-zinc-400">
                @error('form.date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="time" class="uppercase">Hora</label>
                <input wire:model='form.time' type="time" id="time" class="text-sm rounded border-zinc-400">
                @error('form.time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="service" class="uppercase">Servicio</label>
                <select wire:model='form.service' id="service" class="text-sm rounded border-zinc-400">
                    <option value="">Seleccione una opción</option>
                    <option value="hematologia">Hematología</option>
                    <option value="coagulacion">Coagulación</option>
                    <option value="quimica_clinica">Química Clínica</option>
                    <option value="inmunologia">Inmunología</option>
                    <option value="citologia">Citología</option>
                    <option value="urologia_coprologia">Urología y Coprología</option>
                    <option value="microbiologia">Microbiología</option>
                </select>
                @error('form.service')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="reference" class="uppercase">Referencia</label>
                <select wire:model='form.reference' id="reference" class="text-sm rounded border-zinc-400">
                    <option value="">Selecciona una opción</option>
                    <option value="diagnostico_especializado">Diagnóstico Especializado</option>
                    <option value="tratamiento_especifico">Tratamiento específico</option>
                    <option value="segunda_opinion">Segunda Opinión</option>
                    <option value="procedimientos_quirurgicos">Procedimientos Quirúrgicos</option>
                    <option value="rehabilitacion">Rehabilitación</option>
                    <option value="atencion_de_urgencia">Atención de Urgencia</option>
                    <option value="servicios_de_salud_mental">Servicios de salud mental</option>
                    <option value="atencion_materno_infantil">Atención Materno-infantil</option>
                </select>
                @error('form.reference')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-xs" for="referredService" class="uppercase">Servicio referido</label>
                <input wire:model='form.referredService' type="text" id="referredService" class="text-sm rounded border-zinc-400">
                @error('form.referredService')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <div class="flex flex-col mt-5">
            <label class="text-xs" for="diagnosis" class="uppercase">Diagnóstico</label>
            <textarea wire:model='form.diagnosis' id="diagnosis" class="text-sm rounded border-zinc-400"></textarea>
            @error('form.diagnosis')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Drugs search and results --}}
        <fieldset class="mt-10">
            <div class="flex items-center justify-between">
                <legend class="text-[#174075] text-xl">Selección de fármacos</legend>

                <div class="flex justify-end">
                    <button x-on:click.prevent="$dispatch('open-modal', 'searchForMedicine')" class="bg-[#41759D] text-white py-2 px-3 rounded text-xs flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Buscar medicamento
                    </button>
                </div>
            </div>

            {{-- Drugs search --}}
            <section class="drug-search">
                <label for="drugs_search" class="block font-semibold">Nombre del fármaco</label>
                <div class="flex items-center gap-3">
                    <input wire:model.live='search' type="text" id="drugs_search" class="border-none bg-zinc-200 rounded-md py-1 flex-1">
                </div>

                <table class="mt-5 w-full border-collapse rounded-md overflow-hidden">
                    <thead class="bg-[#174075] text-white">
                        <tr>
                            <th class="text-sm p-2">Registro sanitario</th>
                            <th class="text-sm p-2">Nombre del fármaco</th>
                            <th class="text-sm p-2">Agregar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($search)
                            @forelse ($medicines as $medicine)
                                <tr class="bg-zinc-200">
                                    <td class="p-2 text-center font-semibold text-sm">
                                        {{$medicine->health_registration}}
                                    </td>

                                    <td class="p-2 text-sm">
                                        {{$medicine->name}}
                                    </td>

                                    <td class="text-center">
                                        <button type="button" wire:click="setToMedicineList({{$medicine->id}})" class="bg-[#174075] text-white px-2 rounded">
                                            +
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-2 text-center text-sm">NA</td>
                                    <td class="p-2 text-center text-sm text-red-500 font-semibold">Sin registro del fármaco</td>
                                    <td class="p-2 text-center text-sm">NA</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </section>

            {{-- Drugs table --}}
            <section class="drug-table">
                <table class="mt-4 w-full border-collapse rounded-md overflow-hidden">
                    <thead class="bg-[#174075] text-white">
                        <tr>
                            <th class="text-sm px-3 py-2">#</th>
                            <th class="text-sm px-3 py-2">Fármaco</th>
                            <th class="text-xs px-3 py-2">Presentación</th>
                            <th class="text-xs px-3 py-2">Cantidad</th>
                            <th class="text-xs px-3 py-2">Indicaciones (Dósis y vía de administración)</th>
                            <th class="text-xs px-3 py-2">¿Surtido?</th>
                            <th class="text-xs px-3 py-2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="bg-zinc-200">
                        @foreach ($form->medicineResults as $medicineResult)
                            <tr>
                                <td class="p-2 text-sm text-center font-semibold">
                                    {{$medicineResult->health_registration}}
                                </td>

                                <td class="p-2 text-sm text-center">
                                    {{$medicineResult->name}}
                                </td>

                                <td class="p-2 text-sm text-center">
                                    {{$medicineResult->presentation}}
                                </td>

                                <td class="p-2 text-sm text-center">
                                    {{$medicineResult->concentration}}
                                </td>

                                <td class="p-2 text-sm text-center">
                                    {{$medicineResult->indication}}
                                </td>

                                <td class="p-2 text-sm text-center">
                                    Si
                                </td>

                                <td class="p-2 text-sm text-center ">
                                    <button type="button" wire:click='removeMedicine({{$medicineResult->id}})' wire:confirm='¿Desea eliminar de la lista este fármaco?' class="bg-red-500 text-white px-2 rounded">x</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </fieldset>
        {{-- Drugs search and results end --}}

        <fieldset class="mt-10">
            <div class="flex flex-col">
                <label class="text-xs" for="indications" class="uppercase">Indicaciones</label>
                <textarea wire:model='form.indications' id="indications" class="text-sm rounded border-zinc-400"></textarea>
                @error('form.indications')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mt-5">
                <label class="text-xs" for="physicalFolio" class="uppercase">Folio Físico</label>
                <input wire:model='form.physicalFolio' id="physicalFolio" class="text-sm rounded border-zinc-400">
                @error('form.physicalFolio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <div class="flex items-center justify-end mt-8 mb-8">
            <div class="flex gap-3">
                <button type="button" wire:click='getPrescriptions' class="px-8 py-1 bg-[#40759C] text-white rounded-full flex items-center gap-2">
                    Imprimir
                </button>

                {{-- Modal for prescription list --}}

                <x-modal name="list-prescription" :show="false" clean="model" maxWidth="sm">
                    <h2 class="text-[#174075] text-xl">Listado de recetas</h2>

                    <section>
                        @forelse ($prescriptionRecords as $prescriptionRecord)
                            <div class="mt-5 flex items-center gap-4">
                                <div>
                                    <span class="font-semibold">Fecha de creación</span>
                                    <p>
                                        {{$prescriptionRecord->created_at}}
                                    </p>
                                </div>

                                <div>
                                    <button type="button" wire:click='printPrescription({{$prescriptionRecord->id}})' class="p-2 rounded text-white bg-[#174075]">
                                        Imprimir
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="mt-5 text-red-500">No hay recetas aún</p>
                        @endforelse

                    </section>
                </x-modal>

                {{-- End of modal --}}

                <button type="submit" class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Guardar
                </button>

                {{-- <button wire:click.prevent='finish'  class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                    Finalizar consulta
                </button> --}}
            </div>
        </div>
    </form>

    {{-- End for component --}}

</div>
