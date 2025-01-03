<x-app-layout>
    <div class="flex items-center gap-10 py-2 bg-gray-300">
        <i class="fa-solid fa-user-group ml-5"></i>
        <p class="">
            {{'0' . $patient->id . '-' . $patient->name . ' ' . $patient->father_last_name . ' ' .
            $patient->mother_last_name}}
        </p>
    </div>

    @if (request()->routeIs('dashboard.expedientes.summary'))
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

            @if(request()->routeIs('dashboard.expedientes.summary'))

            <section class="mt-3 border">
                <div class="flex items-center justify-between bg-[#174075] text-white p-2">
                    <h2 class="uppercase">Signos vitales</h2>
                    <i class="fa-solid fa-plus text-sm text-[#174075] bg-white aspect-square px-1 rounded-full"></i>
                </div>

                <x-vital-sign vitalSign='Estatura' icon='height.png' value='1.78' unit='mts' color='text-[#03BCF6]' />
                <x-vital-sign vitalSign='Peso' icon='weight.png' value='74' unit='Kg' color='text-[#B755E5]' />
                <x-vital-sign vitalSign='BMI' icon='bmi.png' value='23.4' unit='BMI' color='text-[#A6D61D]' />
                <x-vital-sign vitalSign='Temperatura' icon='temperature.png' value='36.5' unit='°C'
                    color='text-[#E11010]' />
                <x-vital-sign vitalSign='Frec. Respiratoria' icon='respiratory.png' value='17' unit='r/m'
                    color='text-[#1DC724]' />
                <x-vital-sign vitalSign='Presión Arterial' icon='bloodpressure.png' value='120/80' unit='mm/Hg'
                    color='text-[#23CECE]' />
                <x-vital-sign vitalSign='Frec. Cardiaca' icon='heart_rate.png' value='62' unit='Fc'
                    color='text-[#CC17AF]' border='' />
            </section>

            <section class="mt-3 border">
                <div class="flex items-center justify-between bg-[#174075] text-white p-2">
                    <h2 class="uppercase">Archivos</h2>
                    <i class="fa-solid fa-plus text-sm text-[#174075] bg-white aspect-square px-1 rounded-full"></i>
                </div>

                <div class="bg-[#F3FCFE] px-3 py-5 space-y-8">
                    <div class="flex justify-between items-center border-b">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5">
                                <img class="object-cover" src="{{asset('images/pdf.png')}}" alt="pdf icon">
                            </div>
                            <p class="text-sm">Estudios de sangre.pdf</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-xs">250KB | Mayo 20, 2020</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-b">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4">
                                <img class="object-cover w-full" src="{{asset('images/jpge.png')}}" alt="jpeg icon">
                            </div>
                            <p class="text-sm">Radiografía</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-xs">10KB | Abril 30, 2020</p>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button class="bg-[#41759D] text-white flex items-center gap-3 px-3 py-1 rounded">
                            Agregar archivo
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </section>

            @endif
        </aside>

        <section class="w-full">
            <nav class="bg-[#F3FCFE] flex justify-evenly py-1 border text-sm border-l-0">
                <x-nav-link :href="route('dashboard.expedientes.summary', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.summary')">
                    Resumen
                </x-nav-link>

                <div x-data="{ open: false }">
                    <x-nav-link @click="open = !open" class="flex items-center gap-2 cursor-pointer"
                        :active="request()->routeIs('dashboard.expedientes.medicalRecord') || request()->routeIs('dashboard.expedientes.medical-record.identification-form') || request()->routeIs('dashboard.expedientes.medical-record.family-medical-history') || request()->routeIs('dashboard.expedientes.medical-record.pathological-history') || request()->routeIs('dashboard.expedientes.medical-record.no-pathological-history') || request()->routeIs('dashboard.expedientes.medical-record.physical-examination')">
                        Historia Clínica
                        <i class="fa-solid fa-caret-down"></i>
                    </x-nav-link>

                    <div x-show='open' @click.outside="open = false" x-transition
                        class="absolute bg-[#174075] shadow-lg rounded-xl mt-2 p-5 z-10" style="display: none">
                        <nav class="flex flex-col text-white gap-3">
                            <x-nav-link
                                :href="route('dashboard.expedientes.medical-record.identification-form', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ficha de identificación
                            </x-nav-link>

                            <x-nav-link
                                :href="route('dashboard.expedientes.medical-record.family-medical-history', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ant. Heredofamiliares
                            </x-nav-link>

                            <x-nav-link
                                :href="route('dashboard.expedientes.medical-record.pathological-history', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ant. Patológicos
                            </x-nav-link>

                            <x-nav-link
                                :href="route('dashboard.expedientes.medical-record.no-pathological-history', ['id' => $patient->id])"
                                class="hover:text-blue-200 cursor-pointer">
                                Ant. No Patológicos
                            </x-nav-link>

                            <x-nav-link :href="route('dashboard.expedientes.medical-record.physical-examination', ['id' => $patient->id])" class="hover:text-blue-200 cursor-pointer">
                                Exploración Física
                            </x-nav-link>
                        </nav>
                    </div>
                </div>

                <x-nav-link :href="route('dashboard.expedientes.medicalConsultation', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.medicalConsultation')">
                    Consulta Médica
                </x-nav-link>

                <x-nav-link :href="route('dashboard.expedientes.laboratory', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.laboratory')">
                    Laboratorio
                </x-nav-link>

                <x-nav-link :href="route('dashboard.expedientes.reference', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.reference')">
                    Referencia
                </x-nav-link>

                <x-nav-link :href="route('dashboard.expedientes.prescriptionRegister', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.prescriptionRegister')">
                    Recetario
                </x-nav-link>

                <x-nav-link :href="route('dashboard.expedientes.digitalFile', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.digitalFile')">
                    Archivo digital (Anexos)
                </x-nav-link>
            </nav>

            <section class="bg-[#F3FCFE] border border-t-0 ml-6 p-3">
                @yield('content')
            </section>


        </section>
    </div>
</x-app-layout>