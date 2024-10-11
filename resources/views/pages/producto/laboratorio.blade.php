<x-guest-layout>

    <x-slot name="meta">
        <title>Laboratorio | Vission Clinic ECE</title>
        <meta name="description" content="Modulo de laboratorio de Vission Clinic ECE.">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

    <div>
        <div class="grid grid-cols-1">
            <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
                <img class="h-full w-full object-cover object-[center_top]"
                    src="{{asset('images/product-laboratorio.jpeg')}}" alt="Banner Inicio Imagen">
            </div>


            <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
        </div>

        <div class="px-8 md:px-20 py-20">
            <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Laboratorio</h2>

            <div class="space-y-5 mb-10">
                <p>
                    Nuestro sistema de salud Vission Clinic ECE brinda la posibilidad de almacenar fotografías, estudios
                    de
                    laboratorio, radiografías, entre otros documentos dentro del expediente electrónico sin que estos
                    puedan
                    dañarse, como suele suceder en los expedientes físicos, facilitando así el control y seguimiento de
                    los
                    mismos.

                </p>

                <p>

                    Nuestro módulo está ubicado dentro del expediente de cada paciente, así como de forma indivudual
                    desde
                    el
                    menu principal, lo que facilitará la búsqueda de la información. Dentro de los estudios a ingresar,
                    podrás
                    encontrar:
                </p>
            </div>



            <ul class="space-y-2">
                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Hematología
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Coagulación
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Química Clínica
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Inmunología
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Citología
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Urología y Caprología
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Microbiología
                </li>
            </ul>
        </div>

    </div>
</x-guest-layout>