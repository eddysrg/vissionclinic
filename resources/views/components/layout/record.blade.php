<x-app-layout>

    <x-slot:title>
        {{$title}}
    </x-slot:title>

    <div class="flex items-center gap-10 py-2 bg-gray-300">
        <i class="fa-solid fa-user-group ml-5"></i>
        <p class="">
            {{$patient->full_name}}
        </p>
    </div>

    {{$returnButton ?? ''}}

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
                        {{$patient->full_name}}
                    </p>
                </div>
            </section>

            {{-- Summary sections --}}

            {{-- Vital Signs --}}
            @if(request()->routeIs('dashboard.record.summary'))
                <livewire:components.vital-signs :patient="$patient"/>
            @endif

            {{$filesResume ?? ''}}

            {{-- Summary sections end --}}
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
                    request()->routeIs('dashboard.record.family-history') ||
                    request()->routeIs('dashboard.record.pathological-history') ||
                    request()->routeIs('dashboard.record.non-pathological-history') ||
                    request()->routeIs('dashboard.record.physical-examination')
                    ">
                            Historia Clínica
                            <i class="fa-solid fa-caret-down"></i>
                        </x-nav-link>

                        <div x-show='open' @click.outside="open = false" x-transition class="absolute bg-[#174075] shadow-lg rounded-xl mt-2 p-5 z-10" style="display: none">
                            <nav class="flex flex-col text-white gap-3">
                                <x-nav-link
                                    :href="route('dashboard.record.identification-form', ['id' => $patient->id])"
                                    class="hover:text-blue-200 cursor-pointer">
                                    Ficha de identificación
                                </x-nav-link>

                                <x-nav-link
                                    :href="route('dashboard.record.family-history', ['id' => $patient->id])"
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

                    @if($hasAppointment)
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
                    @endif
                </nav>

            <section class="bg-[#F3FCFE] border border-t-0 ml-6 p-3">
                {{$slot}}
            </section>

        </section>
    </div>
</x-app-layout>
