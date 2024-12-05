@extends('record.record')

@section('content')
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
@endsection