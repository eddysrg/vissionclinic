@extends('home.index')

@section('content')
<div>
    <div class="grid grid-cols-1">
        <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
            <img class="h-full w-full object-cover object-[center]" src="{{asset('images/product-ginecologia.jpeg')}}"
                alt="Banner Inicio Imagen">
        </div>


        <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
    </div>

    <div class="px-8 md:px-20 py-20">
        <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Ginecología</h2>

        <div class="space-y-5 mb-10">
            <p>
                Con nuestro software de salud Vission Clinic ECE para ginecólogos tendrás la versatilidad que requiere
                para
                consultar la información de tu consultorio desde cualquier lugar y en cualquier dispositivo electrónico,
                ya sea una computadora, un celular o una tableta. Sólo necesitará estar conectado a internet para
                acceder a la información de su consultorio y cualquier información que modifique será guardada
                automáticamente. Padecimientos que podrás registrar dentro del Vission Clinic ECE:
            </p>
        </div>



        <ul class="flex gap-5 md:gap-24">

            <div class="space-y-2">
                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Desbalance Hormonal
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Detección de Cáncer
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Dismenorrea (Cólicos)
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Dispositivo intrauterino
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Endometriosis
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Infecciones Vaginales
                </li>
            </div>

            <div class="space-y-2">
                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Menopausia
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Ovario Poliquístico
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Planificación familiar
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Sangrado uterino
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Seguimiento de embarazo
                </li>

                <li>
                    <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                    Entre otros ...
                </li>
            </div>

        </ul>
    </div>

</div>
@endsection