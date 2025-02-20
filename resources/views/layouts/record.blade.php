@php
    use App\Models\Patient;

    $patient = Patient::findOrFail($id);
    $medicalConsultation = Patient::with(['record.medicalRecordSections' => function ($query) {
        $query->where('name', 'medical_consultation');
    }, 
    'record.medicalRecordSections.medicalConsultation'
    ])
    ->findOrFail($patient->id) // Use the patient's ID dynamically
    ->record
    ->medicalRecordSections
    ->first()
    ->medicalConsultation 
    ?? [];

    $savedFiles = Patient::MedicalSections($patient->id)
    ->where('name', 'digital_file')
    ->first()->digitalFiles ?? [];
@endphp

<x-app-layout>
    <x-slot:title>
        {{$title}}
    </x-slot>
        
    <div class="flex items-center gap-10 py-2 bg-gray-300">
        <i class="fa-solid fa-user-group ml-5"></i>
        <p class="">
            {{'0' . $patient->id . '-' . $patient->name . ' ' . $patient->father_last_name . ' ' .
            $patient->mother_last_name}}
        </p>
    </div>

    @if (request()->routeIs('dashboard.record.summary'))
    <div class="flex p-5 justify-between">
        <a href="{{route('dashboard.expedientes')}}"
            class="px-5 py-2 bg-[#41759D] text-white rounded-full flex items-center gap-2">
            <i class="fa-solid fa-arrow-left-long"></i>
            Regresar
        </a>
    </div>
    @endif

    <div class="p-5 flex">
        <aside class="w-1/3">
            <section class="border p-5">
                <div class="flex justify-evenly items-center">
                    <div
                        class="w-14 h-14 aspect-square bg-[#174075] text-white flex justify-center items-center rounded-full">
                        <p class="text-2xl">DH</p>
                    </div>

                    <div class="flex flex-col items-center">
                        <h2 class="uppercase text-xs font-semibold">Expediente:</h2>
                        <p class="text-xl">
                            {{'0' . $patient->id}}
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-center mt-5 uppercase">
                        {{$patient->name . ' ' . $patient->father_last_name . ' ' . $patient->mother_last_name}}
                    </p>
                </div>
            </section>

            @if(request()->routeIs('dashboard.record.summary'))

            <section class="mt-3 border">
                <div class="flex items-center justify-between bg-[#174075] text-white p-2">
                    <h2 class="uppercase">Signos vitales</h2>
                    {{-- <i class="fa-solid fa-plus text-sm text-[#174075] bg-white aspect-square px-1 rounded-full"></i> --}}
                </div>

                <x-vital-sign vitalSign='Estatura' icon='height.png' value='{{$medicalConsultation->first()->weight ?? 0}}' unit='m' color='text-[#03BCF6]' />
                <x-vital-sign vitalSign='Peso' icon='weight.png' value='{{$medicalConsultation->first()->height ?? 0}}' unit='Kg' color='text-[#B755E5]' />
                <x-vital-sign vitalSign='IMC' icon='bmi.png' value='{{$medicalConsultation->first()->imc ?? 0}}' unit='IMC' color='text-[#A6D61D]' />
                <x-vital-sign vitalSign='Temperatura' icon='temperature.png' value='{{$medicalConsultation->first()->temperature ?? 0}}' unit='°C'
                    color='text-[#E11010]' />
                <x-vital-sign vitalSign='Frec. Respiratoria' icon='respiratory.png' value='{{$medicalConsultation->first()->respiratoryRate ?? 0}}' unit='rpm'
                    color='text-[#1DC724]' />
                <x-vital-sign vitalSign='Presión Arterial' icon='bloodpressure.png' value='{{$medicalConsultation->first()->blood_pressure ?? 0}}' unit='mmHg'
                    color='text-[#23CECE]' />
                <x-vital-sign vitalSign='Frec. Cardiaca' icon='heart_rate.png' value='{{$medicalConsultation->first()->heart_rate ?? 0}}' unit='lpm'
                    color='text-[#CC17AF]' border='' />
            </section>

            {{-- Files --}}

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

            @endif
        </aside>

        <section class="w-full">
            <nav class="bg-[#F3FCFE] flex justify-evenly py-1 border text-sm border-l-0">
                <x-nav-link :href="route('dashboard.record.summary', ['id' => $patient->id])" :active="request()->routeIs('dashboard.record.summary')">
                    Resumen
                </x-nav-link>

                <div x-data="{ open: false }">
                    <x-nav-link 
                    @click="open = !open" 
                    class="flex items-center gap-2 cursor-pointer"
                    :active="
                    request()->routeIs('dashboard.record.identification-form') || 
                    request()->routeIs('dashboard.record.hereditary-family-history') || 
                    request()->routeIs('dashboard.record.pathological-history') || 
                    request()->routeIs('dashboard.record.non-pathological-history') || 
                    request()->routeIs('dashboard.record.physical-examination')
                    ">
                        Historia Clínica
                        <i class="fa-solid fa-caret-down"></i>
                    </x-nav-link>

                    <div x-show='open' @click.outside="open = false" x-transition class="absolute bg-[#174075] shadow-lg rounded-xl mt-2 p-5 z-10" style="display: none">
                        <nav class="flex flex-col text-white gap-3">
                            <x-nav-link :href="route('dashboard.record.identification-form', ['id' => $patient->id])" class="hover:text-blue-200 cursor-pointer">
                                Ficha de identificación
                            </x-nav-link>

                            <x-nav-link
                                :href="route('dashboard.record.hereditary-family-history', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ant. Heredofamiliares
                            </x-nav-link>

                            <x-nav-link
                                :href="route('dashboard.record.pathological-history', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ant. Patológicos
                            </x-nav-link>

                            <x-nav-link
                                :href="route('dashboard.record.non-pathological-history', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ant. No Patológicos
                            </x-nav-link>

                            <x-nav-link :href="route('dashboard.record.physical-examination', ['id' => $patient->id])" class="hover:text-blue-200 cursor-pointer">
                                Exploración Física
                            </x-nav-link>
                        </nav>
                    </div>
                </div>

                <x-nav-link :href="route('dashboard.record.medical-consultation', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.record.medical-consultation')">
                    Consulta Médica
                </x-nav-link>

                <x-nav-link :href="route('dashboard.record.laboratory', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.record.laboratory')">
                    Laboratorio
                </x-nav-link>

                <x-nav-link :href="route('dashboard.record.reference', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.record.reference')">
                    Referencia
                </x-nav-link>

                <x-nav-link :href="route('dashboard.record.prescription', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.record.prescription')">
                    Recetario
                </x-nav-link>

                <x-nav-link :href="route('dashboard.record.digital-file', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.record.digital-file')">
                    Archivo digital (Anexos)
                </x-nav-link>
            </nav>

            <section class="bg-[#F3FCFE] border border-t-0 ml-6 p-3">
                {{$slot}}
            </section>

        </section>
    </div>
</x-app-layout>