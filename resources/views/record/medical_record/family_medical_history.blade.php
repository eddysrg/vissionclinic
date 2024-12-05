@extends('record.record')

@section('content')
<div class="flex items-center justify-between">
    <h2 class="text-3xl text-[#174075]">Antecedentes Heredofamiliares</h2>

    <div class="flex gap-3">
        <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
            Siguiente
        </button>

        <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
            Imprimir
        </button>

        <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
            Guardar
        </button>
    </div>
</div>

<form action="">
    <div>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="uppercase font-normal text-sm py-8">Maternos</th>
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
                <tr>
                    <td class="uppercase font-normal">Abuela</td>
                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>

                <tr>
                    <td class="uppercase font-normal">Abuelo</td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>

                <tr>
                    <td class="uppercase font-normal">Madre</td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>

                <tr>
                    <td class="uppercase font-normal">Otro</td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <div class="mt-5">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="uppercase font-normal text-sm py-8">Paternos</th>
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
                <tr>
                    <td class="uppercase font-normal">Abuela</td>
                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>

                <tr>
                    <td class="uppercase font-normal">Abuelo</td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>

                <tr>
                    <td class="uppercase font-normal">Madre</td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>

                <tr>
                    <td class="uppercase font-normal">Otro</td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>

                    <td>
                        <input type="radio" class="bg-gray-300 border-none">
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <div class="flex justify-between gap-5 items-end">
        <div class="flex flex-col mt-5">
            <label for="" class="uppercase text-sm">Observaciones</label>
            <textarea name="" id="" cols="60" rows="3" class="w-fit"></textarea>
        </div>

        <div class="flex gap-3">
            <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Siguiente
            </button>

            <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Imprimir
            </button>

            <button class="px-8 py-1 bg-[#174075] text-white rounded-full flex items-center gap-2">
                Guardar
            </button>
        </div>
    </div>
</form>
@endsection