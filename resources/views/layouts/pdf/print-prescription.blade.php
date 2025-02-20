<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receta médica</title>
    <style>
        body {
          font-family: Arial, sans-serif;
          font-size: 12px;
          color: #333;
          margin: 0;
          padding: 0;
        }
        .container {
          padding: 20px;
          border: 1px solid #000;
          max-width: 100%;
        }
        h1 {
          text-align: center;
          font-size: 18px;
          margin-bottom: 20px;
        }
        .section {
          margin-bottom: 15px;
        }
        .section-title {
          font-weight: bold;
          background-color: #f2f2f2;
          padding: 5px;
          border-bottom: 1px solid #ccc;
        }
        .data-table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 10px;
        }
        .data-table th, .data-table td {
          border: 1px solid #ddd;
          padding: 8px;
          text-align: left;
        }
        .data-table th {
          background-color: #f2f2f2;
          font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Receta Médica</h1>
  
        <div class="section">
            <div class="section-title">Datos Generales</div>
            <table class="data-table">
                <tr><th>Fecha</th><td>{{$date}}</td></tr>
                <tr><th>Hora</th><td>{{$time}}</td></tr>
                <tr><th>Servicio</th><td>{{$service}}</td></tr>
                <tr><th>Referencia</th><td>{{$reference}}</td></tr>
                <tr><th>Servicio Referido</th><td>{{$referred_service}}</td></tr>
                <tr><th>Folio Físico</th><td>{{$physical_folio}}</td></tr>
            </table>
        </div>
    
        <div class="section">
            <div class="section-title">Diagnóstico</div>
            <p>{{$diagnosis}}</p>
        </div>
    
        <div class="section">
            <div class="section-title">Indicaciones</div>
            <p>{{$indications}}</p>
        </div>
    
        <div class="section">
            <div class="section-title">Medicamentos Recetados</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Presentación</th>
                        <th>Cantidad</th>
                        <th>Indicaciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($medicine_results as $medicineResult)
                        <tr>
                            <td>{{$medicineResult['name']}}</td>
                            <td>{{$medicineResult['presentation']}}</td>
                            <td>{{$medicineResult['concentration']}}</td>
                            <td>{{$medicineResult['indication']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>