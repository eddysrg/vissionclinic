<x-app-layout>
    <div class="bg-slate-300 flex gap-8 py-2 pl-8">
        <div>
            <i class="fa-solid fa-house"></i>
            <span>|</span>
            <i class="fa-solid fa-user-group"></i>
        </div>
        <p class="font-semibold uppercase">Expedientes</p>
    </div>

    <div class="grid grid-cols-[1fr_.5fr]">
        <div class="p-8">
            <div class="mb-10">
                <form action="">
                    <input class="w-96 rounded-full border border-zinc-300" type="text"
                        placeholder="No. Expediente | Nombre | Apellido P. | Apellido M.">

                    <button class="bg-[#41759D] rounded-full text-white px-5 py-2">
                        Buscar
                        <i class="fa-solid fa-magnifying-glass ml-1"></i>
                    </button>
                </form>
            </div>

            <table class="w-full border border-zinc-300">
                <thead>
                    <tr class="h-10 uppercase border-b border-b-zinc-300">
                        <th>Expediente</th>
                        <th>Nombre</th>
                        <th>Número de contacto</th>
                        <th>Editar</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="text-center h-10 border-b border-b-zinc-300 text-sm">
                        <td>01</td>
                        <td class="uppercase text-[#03BCF6] underline">Diego Hernandez Gomez</td>
                        <td>55 5514991526</td>
                        <td><i class="fa-solid fa-pen-to-square text-[#03BCF6]"></i></td>
                    </tr>

                    <tr class="text-center h-10 border-b border-b-zinc-300 text-sm">
                        <td>02</td>
                        <td class="uppercase text-[#03BCF6] underline">Nancy Leyva Rangel</td>
                        <td>55 5514991526</td>
                        <td><i class="fa-solid fa-pen-to-square text-[#03BCF6]"></i></td>
                    </tr>

                    <tr class="text-center h-10 border-b border-b-zinc-300 text-sm">
                        <td>03</td>
                        <td class="uppercase text-[#03BCF6] underline">Fernanda Gonzalez Flores</td>
                        <td>55 5514991526</td>
                        <td><i class="fa-solid fa-pen-to-square text-[#03BCF6]"></i></td>
                    </tr>

                    <tr class="text-center h-10 border-b border-b-zinc-300 text-sm">
                        <td>04</td>
                        <td class="uppercase text-[#03BCF6] underline">Aldo Castro Sanchéz</td>
                        <td>55 5514991526</td>
                        <td><i class="fa-solid fa-pen-to-square text-[#03BCF6]"></i></td>
                    </tr>

                    <tr class="text-center h-10 border-b border-b-zinc-300 text-sm">
                        <td>05</td>
                        <td class="uppercase text-[#03BCF6] underline">Jessica Camargo Rangel</td>
                        <td>55 5514991526</td>
                        <td><i class="fa-solid fa-pen-to-square text-[#03BCF6]"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-8">
            <h2 class="bg-[#0E2F5E] text-center p-2 text-white uppercase">Acciones Rápidas</h2>

            <div class="bg-[#13C6ED0D] flex flex-col gap-5 p-10 border">
                <button class="text-white bg-[#41759D] p-3 rounded-md">
                    Registro Paciente Nuevo
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>

                <button class="text-white bg-[#41759D] p-3 rounded-md">
                    Agendar cita
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>

                <button class="text-white bg-[#41759D] p-3 rounded-md">
                    Revisar agenda
                    <i class="fa-solid fa-plus ml-2"></i>
                </button>
            </div>
        </div>
    </div>


</x-app-layout>