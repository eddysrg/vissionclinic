<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de identificación</title>
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
                <tr><th>Nombre Completo</th><td>{{$name . ' ' . $paternal_surname . ' ' . $maternal_surname}}</td></tr>
                <tr><th>Sexo</th><td>{{$gender}}</td></tr>
                <tr>
                    <th>Identidad de Género</th>
                    <td>
                        @switch($gender_identity)
                            @case('not-specified')
                                No especificado
                                @break

                            @case('male')
                                Masculino
                                @break

                            @case('female')
                                Femenino
                                @break

                            @case('transgender')
                                Transgénero
                                @break

                            @case('transsexual')
                                Transexual
                                @break

                            @case('transvestite')
                                Travesti
                                @break

                            @case('intersex')
                                Intersexual
                                @break

                            @case('other')
                                Otro
                                @break

                            @default
                        @endswitch
                    </td>
                </tr>
                <tr><th>Edad</th><td>{{$age}}</td></tr>
                <tr><th>Fecha de Nacimiento</th><td>{{$birthdate}}</td></tr>
                <tr><th>Lugar de Nacimiento</th><td>{{$birthplace}}</td></tr>
            </table>
            </div>
        
            <div class="section">
            <div class="section-title">Domicilio</div>
            <table class="data-table">
                <tr><th>Calle</th><td>{{$street}}</td></tr>
                <tr><th>Número</th><td>{{$number}}</td></tr>
                <tr><th>Colonia</th><td>{{$neighborhood}}</td></tr>
                <tr><th>Estado</th><td>{{$state}}</td></tr>
                <tr><th>Código Postal</th><td>{{$zip_code}}</td></tr>
                <tr><th>País</th><td>{{$country}}</td></tr>
            </table>
            </div>
        
            <div class="section">
            <div class="section-title">Otros Datos</div>
            <table class="data-table">
                <tr>
                    <th>Religión</th>
                    <td>
                        @switch($religion)
                            @case('without_religion')
                                Sin religión
                                @break

                            @case('buddhist')
                                Budista
                                @break

                            @case('catholic')
                                Católica
                                @break

                            @case('christian')
                                Cristiana
                                @break

                            @case('jew')
                                Judia
                                @break

                            @case('muslim')
                                Musulmán
                                @break

                            @case('islamic')
                                Islamica
                                @break

                            @case('orthodox')
                                Ortodoxa
                                @break

                            @case('jehovahs_witness')
                                Testigos de Jehová
                                @break

                            @case('protestant')
                                Protestante
                                @break

                            @case('other')
                                Otra religión
                                @break

                            @case('adventist')
                                Adventista
                                @break

                            @case('adventist')
                                Mormón
                                @break

                            @default
                            Sin religión
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <th>Escolaridad</th>
                    <td>
                        @switch($schooling)
                            @case('preschool')
                                Preescolar
                                @break
                            @case('complete_elementary')
                                Primaria Completa
                                @break
                            @case('incomplete_elementary')
                                Preparatoria Incompleta
                                @break
                            @case('complete_secondary')
                                Secundaria Completa
                                @break
                            @case('incomplete_secondary')
                                Secundaria Incompleta
                                @break
                            @case('complete_high_school')
                                Preparatoria Completa
                                @break
                            @case('incomplete_high_school')
                                Preparatoria Incompleta
                                @break
                            @case('technical')
                                Técnica
                                @break
                            @case('bachelor')
                                Licenciatura
                                @break
                            @case('master')
                                Maestría
                                @break
                            @case('doctorate')
                                Doctorado
                                @break
                            @default
                                Otro
                        @endswitch
                    </td>
                </tr>
                <tr><th>Ocupación</th><td>{{$occupation}}</td></tr>
                <tr>
                    <th>Estado Civil</th>
                    <td>
                        @switch($marital_status)
                            @case('married')
                                Casado(a)
                                @break
                            @case('divorced')
                                Divorciado(a)
                                @break
                            @case('single')
                                Soltero(a)
                                @break
                            @case('widower')
                                Viudo(a)
                                @break
                            @case('concubinage')
                                Concubinato
                                @break
                            @case('separated')
                                Separado(a) - En proceso Judicial
                                @break
                            @case('other')
                                Otro
                                @break
                            @default
                                Se ignora
                        @endswitch
                    </td>
                </tr>
                <tr><th>Teléfono Fijo</th><td>{{$landline}}</td></tr>
                <tr><th>Teléfono Móvil</th><td>{{$cellphone}}</td></tr>
                <tr><th>Correo Electrónico</th><td>{{$email}}</td></tr>
                <tr><th>Padre o Tutor</th><td>{{$parent}}</td></tr>
                <tr><th>Teléfono Tutor</th><td>{{$parent_phone}}</td></tr>
                <tr><th>Parentesco</th><td>{{$relationship}}</td></tr>
                <tr><th>Interrogatorio</th><td>{{$interrogation}}</td></tr>
            </table>
            </div>
        </div>
    </body>
</html>