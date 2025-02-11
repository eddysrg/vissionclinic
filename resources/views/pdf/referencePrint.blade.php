<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Referencia Médica</title>
    <style>
        body {
          font-family: Arial, sans-serif;
          font-size: 12px;
          color: #333;
          margin: 20px;
        }
    
        h1 {
          font-size: 16px;
          text-align: center;
          border-bottom: 1px solid #999;
          padding-bottom: 5px;
        }
    
        table {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 20px;
        }
    
        th, td {
          border: 1px solid #ddd;
          padding: 8px;
          text-align: left;
        }
    
        th {
          background-color: #f2f2f2;
        }
    
        .section-title {
          font-weight: bold;
          margin-top: 10px;
          text-transform: uppercase;
        }
    
        .important {
          color: red;
        }
    
        .data-group {
          margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Referencia Médica</h1>
  
    <p>
        <strong>Fecha:</strong> {{ $date }} <strong>Hora:</strong> {{ $time }}
    </p>

    <p>
        <strong>¿Urgente?:</strong> <span class="important">{{ $isUrgent }}</span>
    </p>
  
    <h2 class="section-title">Datos del Paciente</h2>

    <table>
      <tr>
        <th>Peso</th>
        <th>Altura</th>
        <th>IMC</th>
        <th>ICC</th>
      </tr>
      <tr>
        <td>{{ $weight }} kg</td>
        <td>{{ $height }} m</td>
        <td>{{ $imc }}</td>
        <td>{{ $icc }}</td>
      </tr>
    </table>
  
    <h2 class="section-title">Signos Vitales</h2>
    <table>
      <tr>
        <th>Frecuencia Cardíaca</th>
        <th>Frecuencia Respiratoria</th>
        <th>Temperatura</th>
        <th>Glucemia</th>
      </tr>
      <tr>
        <td>{{ $heartRate }} bpm</td>
        <td>{{ $respiratoryRate }} rpm</td>
        <td>{{ $temperature }} °C</td>
        <td>{{ $glycemia }} mg/dL</td>
      </tr>
      <tr>
        <th>Presión Arterial</th>
        <th>Saturación de Oxígeno</th>
        <th>Folio Físico</th>
      </tr>
      <tr>
        <td>{{ $bloodPressure }} mmHg</td>
        <td>{{ $oxygenSaturation }} %</td>
        <td>{{ $physicalFolio }}</td>
      </tr>
    </table>
  
    <h2 class="section-title">Datos de la Referencia</h2>
    <table>
      <tr>
        <th>CLUES</th>
        <td>{{ $clues }}</td>
      </tr>
      <tr>
        <th>Unidad que Refiere</th>
        <td>{{ ucwords(str_replace('_', ' ', $reference_unit)) }}</td>
      </tr>
      <tr>
        <th>Referencia Por</th>
        <td>{{ ucwords(str_replace('_', ' ', $reference_by)) }}</td>
      </tr>
      <tr>
        <th>Entidad</th>
        <td>{{ $entity }}</td>
      </tr>
      <tr>
        <th>Institución de Salud</th>
        <td>{{ $health_institution }}</td>
      </tr>
      <tr>
        <th>Unidad Destino</th>
        <td>{{ $destination_unit }}</td>
      </tr>
      <tr>
        <th>Dirección</th>
        <td>{{ $address }}</td>
      </tr>
      <tr>
        <th>Servicio</th>
        <td>{{ $service }}</td>
      </tr>
    </table>
  
    <h2 class="section-title">Información Adicional</h2>
    <p><strong>Paciente en Ayuno:</strong> {{ $patient_on_fast ? 'Sí' : 'No' }}</p>
    <p><strong>Motivo de Referencia:</strong> {{ $reason_for_reference }}</p>
    <p><strong>Impresión Diagnóstica:</strong> {{ $diagnostic_impression }}</p>
</body>
</html>