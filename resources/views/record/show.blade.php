<x-app-layout>
    <div class="flex items-center gap-10 py-2 bg-gray-300">
        <i class="fa-solid fa-user-group ml-5"></i>
        <p class="">01-Diego Hernández Gómez</p>
    </div>

    <div class="flex p-5 justify-between">
        <button class="px-5 py-2 bg-[#41759D] text-white rounded-full flex items-center gap-2">
            <i class="fa-solid fa-arrow-left-long"></i>
            Regresar
        </button>

        <button class="px-5 py-2 bg-[#41759D] text-white rounded-full flex items-center gap-2">
            Buscar
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>

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
                        <p class="text-xl">01</p>
                    </div>
                </div>

                <div>
                    <p class="text-center mt-5 uppercase">Diego Hernandez Gómez</p>
                </div>
            </section>

            <section class="mt-3 border">
                <div class="flex flex-col items-center bg-[#174075] text-white p-2">
                    <h2 class="uppercase">Padecimiento Actual</h2>
                    <p>Diágnostico previo-evolución</p>
                </div>

                <div class="bg-[#F3FCFE]">
                    <p class="p-8 text-center text-sm">No existe una enfermedad previa</p>
                </div>
            </section>

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
        </aside>

        <section class="w-full">
            <nav class="bg-[#F3FCFE] flex justify-evenly py-1 border text-sm border-l-0">
                <x-nav-link :active="request()->routeIs('dashboard.expedientes.summary')">
                    Resumen
                </x-nav-link>

                <x-nav-link class="flex items-center gap-2"
                    :href="route('dashboard.expedientes.medicalRecord', ['id' => $patient->id])"
                    :active="request()->routeIs('dashboard.expedientes.medicalRecord')">
                    Historia Clínica
                    <i class="fa-solid fa-caret-down"></i>
                </x-nav-link>

                <p>Consulta Médica</p>
                <p>Laboratorio</p>
                <p>Referencia</p>
                <p>Recetario</p>
                <p>Archivo digital (Anexos)</p>
            </nav>

            <section class="bg-[#F3FCFE] border border-t-0 ml-6 p-3">
                <div class="grid grid-cols-2 gap-x-5 gap-y-5">
                    <div class="border self-start">
                        <h2 class="px-5 bg-[#174075] text-white">Antecedentes</h2>

                        <div class="bg-white p-8 space-y-5">
                            <div class="flex items-center gap-2 text-[#03BCF6]">
                                <i class="fa-solid fa-circle-plus"></i>
                                <p class="uppercase">Alergías</p>
                            </div>

                            <div class="flex items-center gap-2 text-[#03BCF6]">
                                <i class="fa-solid fa-circle-plus"></i>
                                <p class="uppercase">Antecedentes más importantes</p>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded-t-lg">
                        <h2 class="text-center py-1 bg-[#41759D] text-white uppercase rounded">
                            Iniciar nueva consulta
                        </h2>

                        <div class="bg-[#D9D9D921] p-5">
                            <h3 class="uppercase text-[#03BCF6] mb-5">Consultas agendadas</h3>

                            <p class="text-sm">
                                Aún no hay citas agendadas
                            </p>

                            <p class="text-sm">
                                Utiliza la <span class="text-[#03BCF6] underline">agenda</span> para calendarizarla
                            </p>

                            <h3 class="uppercase text-[#03BCF6] my-5">Últimas consultas</h3>

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

                            <div class="border bg-white flex mt-5">
                                <div class="w-3 bg-[#174075]"></div>

                                <div class="flex flex-col items-center p-8 border-r">
                                    <p class="text-3xl">15</p>
                                    <span class="text-xs">Jun</span>
                                </div>

                                <div class="w-full p-3">
                                    <div class="flex justify-between items-center">
                                        <p>Dolor de estómago</p>
                                        <span class="text-xs text-gray-500">12:35 PM</span>
                                    </div>

                                    <div class="text-sm mt-2 space-y-1">
                                        <p>K20 - Gastritis aguda</p>
                                        <p>Riopan sobre 20ML</p>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="col-span-2">
                        <h2 class="px-5 bg-[#174075] text-white">Referencias</h2>
                        <div class="bg-white p-4">
                            <div class="flex justify-end">
                                <button class="bg-[#174075] text-white px-5 py-1 rounded-full">Nueva referencia</button>
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
            </section>


        </section>
    </div>
</x-app-layout>