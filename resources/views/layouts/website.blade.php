<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="{{$meta_description ?? 'Default description'}}">
  <meta name="keywords" content="{{$meta_keywords ?? 'Palabras clave'}}">
  <meta name="robots" content="{{$meta_robots ?? 'index,follow'}}">
  <link rel="canonical" href="{{$meta_canonical ?? request()->url()}}">

  <title>{{ $title ?? 'Page Title' }}</title>


  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="{{asset('images/icono_vcl.png')}}" type="image/x-icon">

  <script src="https://kit.fontawesome.com/7c072a50bb.js" crossorigin="anonymous"></script>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @livewire('components.header')

    {{$slot}}

    <x-footer/>
    

  <script>
    function translateToEnglish() {
    // Cargar el script de Google Translate si no se ha cargado aún
    if (!window.googleTranslateLoaded) {
      var script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
      document.head.appendChild(script);
      window.googleTranslateLoaded = true; // Evita cargar el script varias veces
    }

    // Simular la selección de inglés después de cargar Google Translate
    setTimeout(function() {
      var selectElement = document.querySelector('.goog-te-combo');
      if (selectElement) {
        selectElement.value = 'en'; // Selecciona inglés
        selectElement.dispatchEvent(new Event('change')); // Dispara el evento para traducir
      }
    }, 1000); // Espera a que el widget esté listo
    }

    function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'es', // Idioma original de la página
      includedLanguages: 'en,es', // Solo inglés y español como opciones
      autoDisplay: false // No mostrar automáticamente el widget
    }, 'google_translate_element');
    }
  </script>
</body>

</html>