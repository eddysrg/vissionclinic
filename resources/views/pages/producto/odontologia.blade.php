@extends('home.index')

@section('content')
<div>
    <div class="grid grid-cols-1">
        <div class="w-full md:h-[25rem] bg-red-500 col-start-1 col-end-2 row-start-1 row-end-2">
            <img class="h-full w-full object-cover object-[center]" src="{{asset('images/product-odontologia.jpeg')}}"
                alt="Banner Inicio Imagen">
        </div>


        <div class="col-start-1 col-end-2 row-start-1 row-end-2 bg-[#c0c0c0] opacity-50"></div>
    </div>

    <div class="px-8 md:px-20 py-20">
        <h2 class="mb-10 text-4xl text-[#0A125E] font-medium">Odontología</h2>

        <div class="space-y-5 mb-10">
            <p>
                Con nuestro software de salud Health Care podrás brindar un mejor servicio de agendamiento dental y
                administración, tanto para clínicas, centros dentales y dentistas independientes
                Llevarás el control de las atenciones y evoluciones de tus pacientes
            </p>

            <p>
                Al no existir documentos físicos es posible conservar los expedientes electrónicos por un tiempo
                indefinido y poder consultarlos en cualquier momento.
            </p>

            <p>
                El odontograma digital de Health Care es sumamente sencillo de utilizar, con unos cuantos clicks tendrás
                a la vista toda la información dental de tu paciente.
            </p>
        </div>
    </div>

</div>
@endsection