<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\{Patient, Appointment, Prescription};
use Illuminate\View\View;


new
#[Title('Resumen - Vission Clinic ECE')]
class extends Component {

    public $appointments = [];
    public $medicalConsultations = [];
    public $medicines = [];

    public $patient;
    public $medicalConsultation;
    public $savedFiles = [];

    public function setMedicalConsultations()
    {
        foreach ($this->appointments as $appointment) {
            if($appointment->medicalConsultation) {
                $this->medicalConsultations[] = $appointment->medicalConsultation;
                $this->medicalConsultation = $this->medicalConsultations[0];
            }
        }
    }

    public function mount($id)
    {
        $this->patient = Patient::find($id);
        $this->appointments = $this->patient->appointments ?? [];

        if(empty($this->appointments)) {
            return;
        } else {
            $this->setMedicalConsultations();
        }

        //dd($this->medicalConsultation);
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


<x-slot:returnButton>
    <div class="flex p-5 justify-between">
        <a href="{{route('dashboard.expedientes')}}"
            class="px-5 py-2 bg-[#41759D] text-white rounded-full flex items-center gap-2">
            <i class="fa-solid fa-arrow-left-long"></i>
            Regresar
        </a>
    </div>
</x-slot:returnButton>

<x-slot:filesResume>
    <section class="mt-3 border">
        <div class="flex items-center justify-between bg-[#174075] text-white p-2">
            <h2 class="uppercase">Archivos</h2>
        </div>

        <div class="bg-[#F3FCFE] px-3 py-5 space-y-8">

            @forelse ($savedFiles as $file)
                <div class="flex justify-between items-center border-b">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5">
                            <img class="object-cover" src="{{asset('images/pdf.png')}}" alt="pdf icon">
                        </div>
                        <p class="text-sm">{{$file->name}}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-xs">{{$file->size .  ' | ' . $file->created_at->format('d/m/Y')}}</p>
                    </div>
                </div>
            @empty
                <p class="text-center">No hay archivos aún</p>
            @endforelse

            <div class="flex justify-center">
                <a
                    href="{{route('dashboard.record.digital-file', ['id' => $patient->id])}}"
                    class="bg-[#41759D] text-white flex items-center gap-3 px-3 py-1 rounded">
                    Agregar archivo
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </div>
    </section>
</x-slot>


<div>
    <div class="grid grid-cols-2 gap-x-5 gap-y-5">

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

                    <div class="border rounded-md bg-white p-3">
                        <h3 class="text-center text-[#174075] font-semibold uppercase mb-2">Cita Agendada: #{{$appointment->id}}</h3>
                        <div>
                            <h4 class="text-sm text-[#174075] font-semibold">Fecha de consulta:</h4>
                            <p class="text-xs">{{$appointment->date->format('d/m/Y')}}</p>
                        </div>

                        <div class="mt-2">
                            <h4 class="text-sm text-[#174075] font-semibold">Comentarios:</h4>
                            <p class="text-xs">{{$appointment->comments}}</p>
                        </div>

                        <div class="mt-2">
                            <h4 class="text-sm text-[#174075] font-semibold">Estatus:</h4>
                            <p class="text-xs">
                                {{$appointment->status === 'confirm' ? 'Confirmada' : 'Sin confirmar' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div>
                        <p class="text-sm">
                            Aún no hay citas agendadas
                        </p>

                        <p class="text-sm">
                            Utiliza la <a href="{{route('dashboard.agenda')}}" class="text-[#03BCF6] underline">agenda</a>
                            para calendarizarla y poder acceder a las secciones de consulta médica
                        </p>
                    </div>
                @endforelse

                <h3 class="uppercase text-[#03BCF6] my-5">Últimas consultas</h3>

                @forelse ($medicalConsultations as $consultation)
                    <div class="border bg-white flex">
                        <div class="w-3 bg-[#41759D]"></div>

                        <div class="flex flex-col items-center p-8 border-r">
                            <p class="text-3xl">{{$consultation->date->day}}</p>
                            <span class="text-xs">{{$consultation->date->isoFormat('MMM')}}</span>
                        </div>

                        <div class="w-full p-3">
                            <div class="flex justify-between items-center">
                                <p>{{$consultation->reason_for_consultation}}</p>
                                <span class="text-xs text-gray-500">{{$consultation->time->format('H:m')}}</span>
                            </div>

                            <div class="text-xs mt-2 space-y-1">
                                <p>{{$consultation->diseases[0]['catalog_key']}} - {{$consultation->diseases[0]['name']}}
                                </p>
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
</div>

