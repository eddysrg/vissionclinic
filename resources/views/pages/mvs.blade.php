@php
$cardMvsClasses = 'bg-[#0A125E] text-white px-3 py-5 md:p-5 rounded-lg text-center flex justify-center items-center
shadow-xl';
$arrowStyle = 'fa-solid fa-arrow-right text-3xl md:text-5xl text-[#0A125E]';
@endphp

<x-guest-layout>

    <x-slot name="meta">
        <title>Medical View System | Vission Clinic</title>
        <meta name="description"
            content="Medical View System es una colección de servicios inteligentes de software, basados en procesos de ETL.">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

    <div class="md:w-2/3 px-8 md:px-0 md:grid md:grid-cols-[.5fr_.3fr_.5fr] md:grid-rows-[.2fr_1fr] py-8 mx-auto">
        <div class="col-start-1 col-end-3 row-start-1 row-end-3">
            <img class="w-full" src="{{asset('images/mvs-one.png')}}" alt="mvs one">
        </div>

        <div class="
    bg-[#0144E8] 
    text-slate-200 
    p-8 col-start-2 
    col-end-4 
    row-start-2 
    row-end-3 
    text-lg 
    flex
    items-center 
    justify-center">
            <p>
                <span class="font-medium text-white">Medical View System</span> es una colección de servicios
                inteligentes
                de
                software,
                aplicaciones y conectores,
                que basados
                en procesos de ETL, funcionan conjuntamente para convertir diversas fuentes de datos de información
                presentada
                de
                forma gráfica, a través de dashboards interactivas.
            </p>
        </div>
    </div>

    <div class="py-8">
        <p class="text-4xl text-[#0A125E] text-center">Alcance de implementación</p>
        <h2 class="mb-10 text-4xl text-[#0A125E] text-center uppercase font-semibold">Medical View System</h2>

        <div class="px-8 md:px-0 flex flex-col-reverse md:flex-row md:justify-center">
            <div class="
        bg-[#0144E8] 
        text-slate-200 
        p-8 
        text-lg 
        flex
        items-center 
        justify-center 
        md:w-2/5 
        md:mt-10">
                <div>
                    <p class="mb-10">
                        El sistema <span class="font-medium text-white">Medical View System</span> contempla los
                        siguientes
                        requerimientos:
                    </p>

                    <ul class="text-sm space-y-3">
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Hardware y software necesarios para su implementación.
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Versiones actualizadas de software y licencias.
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Vistas o Dashboards.
                            <ul class="list-disc ml-20 py-3 space-y-3">
                                <li>
                                    Información generada por la organización.
                                </li>
                                <li>
                                    Bases de datos/aplicaciones del cliente.
                                </li>
                                <li>
                                    Mínimo y máximo de Dashboards por cliente.
                                </li>
                            </ul>
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Portal web y aplicación desarrollada para iOS y Android.
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Acceso para 10 usuarios.
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            Roles y permisos dependiendo de las necesidades del cliente.
                        </li>
                    </ul>
                </div>

            </div>

            <div class="col-start-1 col-end-3 row-start-1 row-end-3">
                <img class="w-full" src="{{asset('images/mvs-two.png')}}" alt="mvs one">
            </div>
        </div>
    </div>

    <div class="py-10 flex flex-col items-center">
        <h2 class="mb-10 text-4xl text-[#0A125E] text-center">Funcionalidad de MVS</h2>

        <div class="md:w-11/12 md:max-w-5xl flex flex-col gap-20 px-8">
            <div class="
            flex
            flex-col    
            gap-5 
            md:gap-0 
            md:grid 
            md:grid-cols-5 
            md:grid-rows-3">

                <div class="{{$cardMvsClasses}}">
                    <p>Obtener Información</p>
                </div>

                <div class="place-self-center rotate-90 md:rotate-0">
                    <i class="{{$arrowStyle}}"></i>
                </div>

                <div class="{{$cardMvsClasses}}">
                    <p>Crea visualizaciones y reportes</p>
                </div>

                <div class="place-self-center rotate-90 md:rotate-0">
                    <i class="{{$arrowStyle}}"></i>
                </div>

                <div class="{{$cardMvsClasses}}">
                    <p>Creación de dashboards</p>
                </div>

                <div class="place-self-center md:col-start-5 md:col-end-6 rotate-90">
                    <i class="{{$arrowStyle}}"></i>
                </div>

                <div class="{{$cardMvsClasses}} md:col-start-5 md:col-end-6">
                    <p>Crea aplicaciones y comparte su información con otras</p>
                </div>

                <div
                    class="place-self-center md:col-start-4 md:col-end-5 md:row-start-3 md:row-end-4 rotate-90 md:rotate-180">
                    <i class="{{$arrowStyle}}"></i>
                </div>

                <div class="{{$cardMvsClasses}} md:col-start-3 md:col-end-4 md:row-start-3 md:row-end-4">
                    <p>Analiza, monitorea, apoya a la toma de decisiones del negocio u organización</p>
                </div>
            </div>

            <a href="{{route('producto', ['producto' => 'medical-view-system'])}}"
                class="text-white uppercase bg-[#0144E8] p-5 rounded-lg self-center md:self-end">Más información</a>
        </div>
    </div>
</x-guest-layout>