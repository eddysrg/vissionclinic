<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba de PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { margin-bottom: 20px; background-color: #174075}
        .title { color: white; text-align: center}
        .logo { width: 150px; }
        .content { margin: 20px 0; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/ece_white_logo.png') }}" class="logo" alt="Logo">
        <h1 class="title">Ficha de identificación</h1>
    </div>

    <div class="content">
        <p>Hello, {{ $name }}!</p>
        <p>This is a custom PDF generated using DOMPDF.</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} ECE VissionClinic. Todos los derechos reservados.
    </div>
</body>
</html>