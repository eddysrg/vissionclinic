<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, Appointment, Prescription};


new 
#[Layout('layouts.record')] 
#[Title('Resumen - Vission Clinic ECE')]
class extends Component {

    public $id;
    public $patient;
    public $appointments;
    public $medicalRecordSections;
    public $medicalConsultations = [];
    public $medicines = [];

    public function mount($id)
    {
        // Setting data for the correct operation of the component
        $this->patient = Patient::findOrFail($id);
        $this->authorize('viewRecord', $this->patient);
        $this->id = $id;
        $this->appointments = Appointment::find($id)->appointment ?? [];
        $this->medicalRecordSections = Patient::with('record.medicalRecordSections')
        ->find($this->patient->id)
        ->record
        ->medicalRecordSections ?? [];

        //Setting the medical consultations and medicines
        $this->medicalConsultations = $this->medicalRecordSections->where('name', 'medical_consultation')->first()->medicalConsultation ?? [];
        
        $this->medicines = $this->medicalRecordSections->where('name', 'prescriptions')->first()->prescriptions ?? [];
    }
}; ?>

<div class="grid grid-cols-2 gap-x-5 gap-y-5">
    <x-slot:id>
        {{$id}}
        </x-slot>

        <div class="border self-start">
            <h2 class="px-5 bg-[#174075] text-white">Antecedentes</h2>


            <div x-data="{open: false}" class="bg-white p-8 space-y-5">
                <div class="flex items-center gap-2 text-[#03BCF6]">
                    <i :class="open ? 'fa-circle-minus' : 'fa-circle-plus' " class="fa-solid"></i>
                    <button x-on:click="open = !open" class="uppercase">Alergías</button>
                </div>

                <div x-show="open" x-on:click.outside="open = false" style="display: none" x-transition.duration.300ms>
                    <p class="text-sm">Sin antecedentes</p>
                </div>
            </div>
        </div>

        <div class="border rounded-t-lg">
            <h2 class="text-center py-1 bg-[#41759D] text-white uppercase rounded">
                Iniciar nueva consulta
            </h2>

            <div class="bg-[#D9D9D921] p-5">
                <h3 class="uppercase text-[#03BCF6] mb-5">Consultas agendadas</h3>

                @forelse ($appointments as $appointment)
                <div class="border bg-white flex">
                    <div class="w-3 bg-[#41759D]"></div>

                    <div class="flex flex-col items-center p-8 border-r">
                        <p class="text-3xl">20</p>
                        <span class="text-xs">Ago</span>
                    </div>

                    <div class="w-full p-3">
                        <div class="flex justify-between items-center">
                            <p>Dolor de estómago</p>
                            <span class="text-xs text-gray-500">4:35 PM</span>
                        </div>

                        <div class="text-sm mt-2 space-y-1">
                            <p>K20 - Gastritis aguda</p>
                            <p>Riopan sobre 20ML</p>
                        </div>
                    </div>
                </div>
                @empty
                <div>
                    <p class="text-sm">
                        Aún no hay citas agendadas
                    </p>

                    <p class="text-sm">
                        Utiliza la <a href="{{route('dashboard.agenda')}}" class="text-[#03BCF6] underline">agenda</a>
                        para calendarizarla
                    </p>
                </div>
                @endforelse

                <h3 class="uppercase text-[#03BCF6] my-5">Últimas consultas</h3>

                @forelse ($medicalConsultations as $consultation)
                <div class="border bg-white flex">
                    <div class="w-3 bg-[#41759D]"></div>

                    <div class="flex flex-col items-center p-8 border-r">
                        @php
                        Carbon\Carbon::setLocale('es');
                        @endphp
                        <p class="text-3xl">{{Carbon\Carbon::parse($consultation->date)->day}}</p>
                        <span class="text-xs">{{Carbon\Carbon::parse($consultation->date)->isoFormat('MMM')}}</span>
                    </div>

                    <div class="w-full p-3">
                        <div class="flex justify-between items-center">
                            <p>{{$consultation->current_condition}}</p>
                            <span class="text-xs text-gray-500">4:35 PM</span>
                        </div>

                        <div class="text-sm mt-2 space-y-1">
                            <p>{{$consultation->diseases[0]['catalog_key']}} - {{$consultation->diseases[0]['name']}}
                            </p>
                            {{-- <p>Riopan sobre 20ML</p> --}}
                        </div>
                    </div>
                </div>
                @empty
                <div>
                    <p class="text-sm">
                        Aún no hay consultas
                    </p>
                </div>
                @endforelse

            </div>


        </div>

        <div class="col-span-2">
            <h2 class="px-5 bg-[#174075] text-white">Referencias</h2>
            <div class="bg-white p-4">
                <div class="flex justify-end">
                    <a href="{{route('dashboard.record.reference', ['id' => $patient->id])}}"
                        class="bg-[#174075] text-white px-5 py-1 rounded-full">Nueva referencia</a>
                </div>

                <div class="mt-5">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="font-normal text-sm">N° Referencia</th>
                                <th class="font-normal text-sm">Fecha</th>
                                <th class="font-normal text-sm">Unidad origen</th>
                                <th class="font-normal text-sm">Unidad destino</th>
                                <th class="font-normal text-sm">Servicio</th>
                                <th class="font-normal text-sm">Contrareferencia</th>
                                <th class="font-normal text-sm">Estatus</th>
                                <th class="font-normal text-sm">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</div>