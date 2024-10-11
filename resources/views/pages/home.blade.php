@php
$carouselClasses = 'w-full flex flex-nowrap overflow-x-scroll';
$metaTitle = "Vission Clinic - Inicio"
@endphp

<x-guest-layout>
    <x-slot name="meta">
        <title>Vission Clinic</title>
        <meta name="description"
            content="Vission Clinic es la herramienta que optimiza la atención que se brinda en unidades médicas y centros de salud.">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index,follow">
    </x-slot>

    <div class="carousel-container">
        <div class="carousel">
            <section class="carousel-item item-one">
                <div
                    class="h-full px-10 xl:px-0 max-w-7xl mx-auto flex flex-col items-center md:items-end justify-center text-white">
                    <div class="text-center md:text-end space-y-5">
                        <span class="mb-5 md:mb-0 lg:text-2xl drop-shadow-lg">
                            El mejor expediente Clínico Electrónico
                        </span>
                        <h2 class="text-4xl lg:text-7xl drop-shadow-lg">
                            Vission Clinic ECE
                        </h2>
                        <p class="block text-5xl lg:text-8xl uppercase drop-shadow-lg mt-4 md:mt-0">NIVEL 1</p>
                    </div>

                    <a href="{{route('ece', ['nivel' => 'nivel-uno'])}}"
                        class="text-base md:text-base justify-end px-10 py-4 md:px-8 md:py-3 bg-[#0A125E] rounded-full mt-10 relative">
                        Leer más
                    </a>
                </div>
            </section>

            <section class="carousel-item item-two">
                <div
                    class="h-full px-10 xl:px-0 max-w-7xl mx-auto flex flex-col items-center md:items-end justify-center text-white">
                    <div class="text-center md:text-end space-y-5">
                        <span class="mb-5 md:mb-0 lg:text-2xl drop-shadow-lg">
                            Sistema de Telemedicina y Telemonitorización
                        </span>
                        <h2 class="text-4xl lg:text-7xl drop-shadow-lg">
                            Vission Clinic ECE
                        </h2>
                        <p class="block text-5xl lg:text-8xl uppercase drop-shadow-lg mt-4 md:mt-0">NIVEL 2</p>
                    </div>

                    <a href="{{route('ece', ['nivel' => 'nivel-dos'])}}"
                        class="text-base md:text-base justify-end px-10 py-4 md:px-8 md:py-3 bg-[#0A125E] rounded-full mt-10 relative">
                        Leer más
                    </a>
                </div>
            </section>

            <section class="carousel-item item-three">
                <div
                    class="h-full px-10 xl:px-0 max-w-7xl mx-auto flex flex-col items-center md:items-end justify-center text-white">
                    <div class="text-center md:text-end space-y-5">
                        <span class="mb-5 md:mb-0 lg:text-2xl drop-shadow-lg">
                            Sistema de información para laboratorios
                        </span>
                        <h2 class="text-4xl lg:text-7xl drop-shadow-lg">
                            Medical View System
                        </h2>
                        <p class="block text-5xl lg:text-8xl uppercase drop-shadow-lg mt-4 md:mt-0">(MVS)</p>
                    </div>

                    <a class="text-base md:text-base justify-end px-10 py-4 md:px-8 md:py-3 bg-[#0A125E] rounded-full mt-10 relative"
                        href="{{route('mvs')}}">
                        Leer más
                    </a>
                </div>
            </section>

            <section class="carousel-item item-four">
                <div
                    class="h-full px-10 xl:px-0 max-w-7xl mx-auto flex flex-col items-center md:items-end justify-center text-white">
                    <div class="text-center md:text-end space-y-5">
                        <span class="mb-5 md:mb-0 lg:text-2xl drop-shadow-lg">
                            Sistema de Seguridad con nuestro asistente de
                        </span>
                        <h2 class="text-4xl lg:text-7xl drop-shadow-lg">
                            Inteligencia Avanzada:
                        </h2>
                        <p class="block text-5xl lg:text-8xl uppercase drop-shadow-lg mt-4 md:mt-0">LYRIUM</p>
                    </div>

                    <a class="text-base md:text-base justify-end px-10 py-4 md:px-8 md:py-3 bg-[#0A125E] rounded-full mt-10 relative"
                        href="{{route('lyrium')}}">
                        Leer más
                    </a>
                </div>
            </section>

            <section class="carousel-item item-five">
                <div
                    class="h-full px-10 xl:px-0 max-w-7xl mx-auto flex flex-col items-center md:items-end justify-center text-white">
                    <div class="text-center md:text-end space-y-5">
                        <span class="mb-5 md:mb-0 lg:text-2xl drop-shadow-lg">
                            El mejor sistema de información para Hospitales
                        </span>
                        <h2 class="text-4xl leading-normal lg:text-7xl lg:leading-normal drop-shadow-lg">
                            Digitalización de imágenes en salas de Hospitales
                        </h2>
                    </div>

                    <a class="text-base md:text-base justify-end px-10 py-4 md:px-8 md:py-3 bg-[#0A125E] rounded-full mt-10 relative"
                        href="{{route('mvs')}}">
                        Leer más
                    </a>
                </div>
            </section>


        </div>

        <i class="fa-solid fa-chevron-left arrow-prev"></i>
        <i class="fa-solid fa-chevron-right arrow-next"></i>
    </div>

    <div class="bg-[#0144E8]">
        <h1
            class="text-white uppercase text-center py-11 text-xl leading-normal lg:text-2xl lg:leading-relaxed px-8 md:px-28">
            Vission Clinic tiene por objetivo optimizar la atención que se brinda en unidades médicas y centros de
            salud.
        </h1>
    </div>

    <div class="py-9 px-8">
        <h2 class="text-[#0A125E] uppercase text-3xl text-center font-medium mb-8 pruebita">Nuestras Soluciones</h2>

        <div class="relative flex flex-col-reverse md:flex-row items-center md:justify-center gap-8 md:gap-5">
            <div class="list-carousel-container mb-28">
                <div class="list-carousel">
                    <ul class="list-carousel-item text-[#0A125E] space-y-3 font-medium md:text-lg">
                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Expediente Clínico Electrónico Vission Clinic ECE
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Desarrollo de aplicaciones
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Business Intelligence and Analitycs
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Servicios en nube
                        </li>

                        <li class="
                        before:content-['']
                        before:aspect-square 
                        before:w-2 
                        before:h-2 
                        before:bg-gradient-to-b 
                        before:from-[#0144E8] 
                        before:to-[#0A125E] 
                        before:inline-block 
                        before:mr-1 
                        before:rounded-full">
                            Almacenamiento y continuidad de negocio
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Diseño administrativo y mantenimiento
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Soporte y servicio de Mesa de ayuda
                        </li>
                    </ul>

                    <ul class="list-carousel-item text-[#0A125E] space-y-3 font-medium md:text-lg">
                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Consultoria
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Servicios de Redes e infraestructura
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Project Management
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Servicio de seguridad en la red
                        </li>

                        <li class="
                        before:content-['']
                        before:aspect-square 
                        before:w-2 
                        before:h-2 
                        before:bg-gradient-to-b 
                        before:from-[#0144E8] 
                        before:to-[#0A125E] 
                        before:inline-block 
                        before:mr-1 
                        before:rounded-full">
                            Sistemas de integración
                        </li>

                        <li class="
                    before:content-['']
                    before:aspect-square 
                    before:w-2 
                    before:h-2 
                    before:bg-gradient-to-b 
                    before:from-[#0144E8] 
                    before:to-[#0A125E] 
                    before:inline-block 
                    before:mr-1 
                    before:rounded-full">
                            Servicios unificados de voz
                        </li>
                    </ul>
                </div>
            </div>


            <div class="grid grid-cols-[.2fr_.7fr_.1fr] grid-rows-[.1fr_.8fr_.5fr] sm:w-2/4 xl:w-auto">
                <div class="col-start-1 col-end-3 row-start-2 row-end-4 order-1">
                    <img class="w-full h-full " src="{{asset('images/soluciones_imagen.png')}}" alt="Soluciones Imagen">
                </div>

                <div class="col-start-2 col-end-4 row-start-1 row-end-3">
                    <img class=" w-full h-full" src="{{asset('images/fondo_soluciones_imagen.png')}}"
                        alt="Soluciones Imagen">
                </div>
            </div>

            <i class="fa-solid fa-circle-left list-arrow-prev"></i>
            <i class="fa-solid fa-circle-right list-arrow-next"></i>

        </div>
    </div>

    <div>
        <div class="hidden md:block last-carousel-container">
            <div class="last-carousel">
                <div class="last-carousel-item grid md:grid-cols-2">
                    <div class=" bg-[#0144E8] text-white py-6 flex items-center">
                        <p class="
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                            La plataforma digital del expediente clínico, hoy en día permite un manejo más eficiente de
                            la
                            información
                            que se genera a partir de la atención a los pacientes, en las unidades de salud.
                        </p>
                    </div>

                    <div class="bg-[#0A125E] text-white py-6 flex items-center">
                        <p class="
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                            Vission Clinic ECE&reg; es una herramienta práctica para el manejo del Expediente Clínico de
                            forma
                            digital,
                            sabiéndolo utilizar correctamente. Los beneficios: rapidez, disminuye consumo de papel,
                            tiene
                            mayores
                            herramientas de llenado.
                        </p>
                    </div>
                </div>

                <div class="last-carousel-item grid md:grid-cols-2">
                    <div class=" bg-[#0144E8] text-white py-6 flex items-center">
                        <p class="
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                            Vission Clinic® es una herramienta muy completa, fácil de manejar y
                            sumamente útil para una mejor atención de los pacientes. Te permite agilizar la consulta,
                            llevar
                            una agenda actualizada, mejor control y registros de pacientes. Es una maravilla porque
                            aligera
                            la carga de trabajo, y ayuda a resguardar mejor la información, pero sobre todo, mejora la
                            calidad de atención a los pacientes.
                        </p>
                    </div>

                    <div class="bg-[#0A125E] text-white py-6 flex items-center">
                        <p class="
                    
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                            La herramienta facilita la comunicación entre el personal médico que la utiliza, ya que
                            permite
                            consultar las observaciones que se hacen al paciente de acuerdo a los servicios que le
                            fueron
                            prestados, de igual forma brinda confidencialidad ya que se entregan accesos personalizados
                            y
                            únicamente puedan accesar a la información del paciente aquellas personas previamente
                            autorizadas que cuentan con claves de acceso.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="md:hidden mb-last-carousel-container">
            <div class="mb-last-carousel">
                <div class="mb-last-carousel-item bg-[#0144E8] text-white py-6 flex items-center">
                    <p class="
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                        La plataforma digital del expediente clínico, hoy en día permite un manejo más eficiente de la
                        información
                        que se genera a partir de la atención a los pacientes, en las unidades de salud.
                    </p>
                </div>

                <div class="mb-last-carousel-item bg-[#0A125E] text-white py-6 flex items-center">
                    <p class="
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                        Vission Clinic ECE&reg; es una herramienta práctica para el manejo del Expediente Clínico de
                        forma
                        digital,
                        sabiéndolo utilizar correctamente. Los beneficios: rapidez, disminuye consumo de papel, tiene
                        mayores
                        herramientas de llenado.
                    </p>
                </div>

                <div class="mb-last-carousel-item bg-[#0144E8] text-white py-6 flex items-center">
                    <p class="
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                        Vission Clinic ECE® es una herramienta muy completa, fácil de manejar y
                        sumamente útil para una mejor atención de los pacientes. Te permite agilizar la consulta, llevar
                        una agenda actualizada, mejor control y registros de pacientes. Es una maravilla porque aligera
                        la carga de trabajo, y ayuda a resguardar mejor la información, pero sobre todo, mejora la
                        calidad de atención a los pacientes.
                    </p>
                </div>

                <div class="mb-last-carousel-item bg-[#0A125E] text-white py-6 flex items-center">
                    <p class="
                    
                    w-4/5
                    mx-auto
                    before:content-['']
                    before:aspect-square
                    before:w-10
                    before:h-10
                    before:bg-[url('../../public/images/comas.png')] 
                    before:bg-contain
                    before:bg-no-repeat
                    before:bg-center
                    before:inline-block 
                    before:ml-8
                    before:mr-4">
                        La herramienta facilita la comunicación entre el personal médico que la utiliza, ya que permite
                        consultar las observaciones que se hacen al paciente de acuerdo a los servicios que le fueron
                        prestados, de igual forma brinda confidencialidad ya que se entregan accesos personalizados y
                        únicamente puedan accesar a la información del paciente aquellas personas previamente
                        autorizadas que cuentan con claves de acceso.
                    </p>
                </div>
            </div>
        </div>




        <div class="py-4 flex justify-center space-x-6">
            <div class="w-3 h-3 rounded-full bg-[#0A125E] aspect-square"></div>
            <div class="w-3 h-3 rounded-full bg-[#0A125E] aspect-square"></div>
            <div class="w-3 h-3 rounded-full bg-[#0A125E] aspect-square"></div>
            <div class="w-3 h-3 rounded-full bg-[#0A125E] aspect-square"></div>
        </div>
    </div>

    <script>
        function initCarousel({
        carouselSelector,
        itemSelector,
        prevArrowSelector,
        nextArrowSelector,
        interval = 5000,
        }) {
        const carousel = document.querySelector(carouselSelector);
        const sliders = document.querySelectorAll(itemSelector);
        const arrowPrev = document.querySelector(prevArrowSelector);
        const arrowNext = document.querySelector(nextArrowSelector);
    
        let operacion = 0;
        let counter = 0;
        let widthSlider = 100 / sliders.length;
    
        // Mueve el carrusel hacia la derecha automáticamente cada 'interval' milisegundos
        const autoSlide = setInterval(() => {
            toRight();
        }, interval);
    
        // Listeners para las flechas de navegación
        arrowNext.addEventListener("click", toRight);
        arrowPrev.addEventListener("click", toLeft);
    
        function toRight() {
            if (counter >= sliders.length - 1) {
                counter = 0;
                operacion = 0;
                carousel.style.transform = `translateX(-${operacion}%)`;
                carousel.style.transition = "none";
                return;
            }
    
            counter++;
            operacion = operacion + widthSlider;
            carousel.style.transform = `translateX(-${operacion}%)`;
            carousel.style.transition = "all ease .6s";
        }
    
        function toLeft() {
            counter--;
    
            if (counter < 0) {
                counter = sliders.length - 1;
                operacion = widthSlider * (sliders.length - 1);
                carousel.style.transform = `translate(-${operacion}%)`;
                carousel.style.transition = "none";
                return;
            }
    
            operacion = operacion - widthSlider;
            carousel.style.transform = `translateX(-${operacion}%)`;
            carousel.style.transition = "all ease .6s";
        }
    }
    
    initCarousel({
        carouselSelector: ".carousel",
        itemSelector: ".carousel-item",
        prevArrowSelector: ".arrow-prev",
        nextArrowSelector: ".arrow-next",
        interval: 5000, // Opcional: puedes cambiar el intervalo de tiempo
    });
    
    initCarousel({
        carouselSelector: ".list-carousel",
        itemSelector: ".list-carousel-item",
        prevArrowSelector: ".list-arrow-prev",
        nextArrowSelector: ".list-arrow-next",
        interval: 3000, // Opcional: puedes cambiar el intervalo de tiempo
    });
    
    initCarousel({
        carouselSelector: ".last-carousel",
        itemSelector: ".last-carousel-item",
        prevArrowSelector: ".arrow-prev",
        nextArrowSelector: ".arrow-next",
        interval: 3000, // Opcional: puedes cambiar el intervalo de tiempo
    });
    
    initCarousel({
        carouselSelector: ".mb-last-carousel",
        itemSelector: ".mb-last-carousel-item",
        prevArrowSelector: ".arrow-prev",
        nextArrowSelector: ".arrow-next",
        interval: 5000, // Opcional: puedes cambiar el intervalo de tiempo
    });
    
    </script>
</x-guest-layout>