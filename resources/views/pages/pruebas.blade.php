{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba de PDF</title>
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
          <h1>Ficha de Identificación Médica</h1>
      
          <div class="section">
            <div class="section-title">Datos Generales</div>
            <table class="data-table">
              <tr><th>Nombre Completo</th><td>Juan Carlos Pérez López</td></tr>
              <tr><th>Sexo</th><td>Masculino</td></tr>
              <tr><th>Identidad de Género</th><td>Masculino</td></tr>
              <tr><th>Edad</th><td>35</td></tr>
              <tr><th>Fecha de Nacimiento</th><td>15 de marzo de 1988</td></tr>
              <tr><th>Lugar de Nacimiento</th><td>Ciudad de México</td></tr>
            </table>
          </div>
      
          <div class="section">
            <div class="section-title">Domicilio</div>
            <table class="data-table">
              <tr><th>País</th><td>México</td></tr>
              <tr><th>Estado</th><td>Ciudad de México</td></tr>
              <tr><th>Código Postal</th><td>01234</td></tr>
              <tr><th>Colonia</th><td>Del Valle</td></tr>
              <tr><th>Calle</th><td>Avenida Insurgentes</td></tr>
              <tr><th>Número</th><td>123</td></tr>
            </table>
          </div>
      
          <div class="section">
            <div class="section-title">Otros Datos</div>
            <table class="data-table">
              <tr><th>Religión</th><td>Católica</td></tr>
              <tr><th>Escolaridad</th><td>Licenciatura en Ingeniería</td></tr>
              <tr><th>Ocupación</th><td>Ingeniero de Software</td></tr>
              <tr><th>Estado Civil</th><td>Casado</td></tr>
              <tr><th>Teléfono Fijo</th><td>55-1234-5678</td></tr>
              <tr><th>Teléfono Móvil</th><td>55-9876-5432</td></tr>
              <tr><th>Correo Electrónico</th><td>juan.perez@example.com</td></tr>
              <tr><th>Padre o Tutor</th><td>Roberto Pérez Gutiérrez</td></tr>
              <tr><th>Teléfono Tutor</th><td>55-8765-4321</td></tr>
              <tr><th>Parentesco</th><td>Padre</td></tr>
              <tr><th>Interrogatorio</th><td>Paciente consciente, orientado y cooperativo.</td></tr>
            </table>
          </div>
        </div>
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
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

  <p><strong>Fecha:</strong> 2025-02-11 <strong>Hora:</strong> 12:57</p>
  <p><strong>¿Urgente?:</strong> <span class="important">Sí</span></p>

  <h2 class="section-title">Datos del Paciente</h2>
  <table>
    <tr>
      <th>Peso</th>
      <th>Altura</th>
      <th>IMC</th>
      <th>ICC</th>
    </tr>
    <tr>
      <td>70 kg</td>
      <td>1.66 m</td>
      <td>25.40</td>
      <td>0.85</td>
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
      <td>72 bpm</td>
      <td>16 rpm</td>
      <td>36.8 °C</td>
      <td>90 mg/dL</td>
    </tr>
    <tr>
      <th>Presión Arterial</th>
      <th>Saturación de Oxígeno</th>
      <th>Folio Físico</th>
    </tr>
    <tr>
      <td>120/80 mmHg</td>
      <td>98%</td>
      <td>ADSKDJSL73974397</td>
    </tr>
  </table>

  <h2 class="section-title">Datos de la Referencia</h2>
  <table>
    <tr>
      <th>CLUES</th>
      <td>ASCIJ000012</td>
    </tr>
    <tr>
      <th>Unidad que Refiere</th>
      <td>Medicina General</td>
    </tr>
    <tr>
      <th>Referencia Por</th>
      <td>Diagnóstico Especializado</td>
    </tr>
    <tr>
      <th>Entidad</th>
      <td>Aguascalientes</td>
    </tr>
    <tr>
      <th>Institución de Salud</th>
      <td>Centros de Integración Juvenil</td>
    </tr>
    <tr>
      <th>Unidad Destino</th>
      <td>Centro de Integración Juvenil, A.C. Unidad Operativa Aguascalientes</td>
    </tr>
    <tr>
      <th>Dirección</th>
      <td>Emiliano Zapata 117, Col. Aguascalientes Centro, C.P 20000</td>
    </tr>
    <tr>
      <th>Servicio</th>
      <td>Medicina General</td>
    </tr>
  </table>

  <h2 class="section-title">Información Adicional</h2>
  <p><strong>Paciente en Ayuno:</strong> Sí</p>
  <p><strong>Motivo de Referencia:</strong> Porque aquí no hay suficiente recurso para atender</p>
  <p><strong>Impresión Diagnóstica:</strong> Probable infección respiratoria</p>
</body>
</html>
