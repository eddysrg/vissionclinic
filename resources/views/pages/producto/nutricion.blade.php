@extends('home.index')

@section('content')
<div>
    <div class="grid grid-cols-1">
        <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
            <img class="h-full w-full object-cover object-[center]" src="{{asset('images/product-nutricion.jpeg')}}"
                alt="Banner Inicio Imagen">
        </div>


        <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
    </div>

    <div class="px-8 md:px-20 py-20">
        <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Nutrición</h2>

        <div class="space-y-5 mb-10">
            <p>
                Con el módulo de nutrición podrás registrar hábitos y antecedentes alimenticios, evaluación
                antropometrica, estilo de vida, dieta y alimentación, plan aliementario.
            </p>

            <p>
                Con nuestro Software de salud Vission Clinic ECE, tendrás el control de los datos importantes para
                conocer
                información relevante de tu paciente y así ofrecerle una dieta adecuada. Gracias al registro digital,
                los datos que se recolecten de tus pacientes pueden ser más y más completos. Puedes conectar tablets,
                ordenadores, ebooks a la red y actualizar el contenido directamente sin mayor esfuerzo.
            </p>

            <p>
                Podrás recopilar datos generales de tu paciente y otros datos más específicos que para ti pueden ser
                importantes, como son:
            </p>
        </div>



        <ul class="space-y-2">
            <li>
                <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                Antecedentes
            </li>

            <li>
                <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                Evaluación antropometrica
            </li>

            <li>
                <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                Estilo de vida
            </li>

            <li>
                <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                Dieta y alimentación
            </li>

            <li>
                <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                Plan alimentario
            </li>

            <li>
                <i class="fa-solid fa-circle-chevron-right text-[#0A125E] mr-2"></i>
                Consulta
            </li>
        </ul>
    </div>

</div>
@endsection