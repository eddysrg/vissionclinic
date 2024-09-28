<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vission Clinic') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-header />

    @yield('content')

    <x-footer />

    @stack('scripts-carousel')

    <script type="text/javascript">
        function translateToEnglish() {
          // Cargar el script de Google Translate si no se ha cargado aún
          if (!window.googleTranslateLoaded) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            document.head.appendChild(script);
            window.googleTranslateLoaded = true; // Para evitar cargarlo varias veces
          }
      
          // Simular la selección de inglés después de que se cargue Google Translate
          setTimeout(function() {
            var selectElement = document.querySelector('.goog-te-combo');
            if (selectElement) {
              selectElement.value = 'en'; // Selecciona inglés
              selectElement.dispatchEvent(new Event('change')); // Dispara el evento de cambio para iniciar la traducción
            }
          }, 1000); // Tiempo de espera para asegurar que el widget esté listo
        }
      
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({
            pageLanguage: 'es', // Idioma original de la página
            includedLanguages: 'en', // Solo inglés como opción
            autoDisplay: false // No mostrar automáticamente el widget
          }, 'google_translate_element');
        }
    </script>


</body>

</html>