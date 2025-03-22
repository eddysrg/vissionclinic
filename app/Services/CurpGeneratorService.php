<?php

namespace App\Services;

class CurpGeneratorService
{
    private static $valores = [
        '0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4,
        '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
        'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14,
        'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19,
        'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'Ñ' => 24,
        'O' => 25, 'P' => 26, 'Q' => 27, 'R' => 28, 'S' => 29,
        'T' => 30, 'U' => 31, 'V' => 32, 'W' => 33, 'X' => 34,
        'Y' => 35, 'Z' => 36
    ];

    public static function generateCURP($name, $lastName, $birthdate, $gender, $birthplace)
    {

        // Array de los apellidos
        $lastNameArray = explode(' ', $lastName);

        // Convertir a mayúsculas
        $name = strtoupper($name);
        $paternalLastName = strtoupper($lastNameArray[0]);
        $maternalLastName = strtoupper($lastNameArray[1]);
        $gender = strtoupper($gender);
        $birthplace = strtoupper($birthplace);

        // Generar los primeros 16 caracteres de la CURP
        $curp = self::generarBaseCURP($name, $paternalLastName, $maternalLastName, $birthdate, $gender, $birthplace);

        // Calcular la homoclave (posición 17)
        $birthYear = (int)substr($birthdate, 0, 4);
        $homoclave = self::calcularHomoclave($curp, $birthYear);
        $curp .= $homoclave;

        // Calcular el dígito verificador (posición 18)
        $digitoVerificador = self::calcularDigitoVerificador($curp);
        $curp .= $digitoVerificador;

        return $curp;
    }

    // Genera los primeros 16 caracteres de la CURP
    private static function generarBaseCURP($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $entidadFederativa)
    {
        $curp = '';

        // 1. Primera letra del apellido paterno
        $curp .= substr($apellidoPaterno, 0, 1);

        // 2. Primera vocal interna del apellido paterno
        $vocales = ['A', 'E', 'I', 'O', 'U'];
        for ($i = 1; $i < strlen($apellidoPaterno); $i++) {
            if (in_array($apellidoPaterno[$i], $vocales)) {
                $curp .= $apellidoPaterno[$i];
                break;
            }
        }

        // 3. Primera letra del apellido materno
        $curp .= substr($apellidoMaterno, 0, 1);

        // 4. Primera letra del nombre
        $curp .= substr($nombre, 0, 1);

        // 5. Fecha de nacimiento (YYMMDD)
        $curp .= date('ymd', strtotime($fechaNacimiento));

        // 6. Sexo (H o M)
        $curp .= substr($sexo, 0, 1);

        // 7. Entidad federativa (2 caracteres)
        $curp .= $entidadFederativa;

        // 8. Primera consonante interna del apellido paterno
        for ($i = 1; $i < strlen($apellidoPaterno); $i++) {
            if (!in_array($apellidoPaterno[$i], $vocales)) {
                $curp .= $apellidoPaterno[$i];
                break;
            }
        }

        // 9. Primera consonante interna del apellido materno
        for ($i = 1; $i < strlen($apellidoMaterno); $i++) {
            if (!in_array($apellidoMaterno[$i], $vocales)) {
                $curp .= $apellidoMaterno[$i];
                break;
            }
        }

        // 10. Primera consonante interna del nombre
        for ($i = 1; $i < strlen($nombre); $i++) {
            if (!in_array($nombre[$i], $vocales)) {
                $curp .= $nombre[$i];
                break;
            }
        }

        return $curp;
    }

    // Calcula la homoclave (posición 17)
    private static function calcularHomoclave($curp, $anioNacimiento)
    {
        if ($anioNacimiento <= 1999) {
            // Para nacidos hasta 1999, la homoclave es un número del 0 al 9
            $suma = self::calcularSumaPonderada($curp, 16);
            $residuo = $suma % 10;
            return (string)$residuo;
        } else {
            // Para nacidos a partir de 2000, la homoclave es una letra de A a J
            $suma = self::calcularSumaPonderada($curp, 16);
            $residuo = $suma % 10;
            return chr(65 + $residuo); // A=0, B=1, ..., J=9
        }
    }

    // Calcula el dígito verificador (posición 18)
    private static function calcularDigitoVerificador($curp)
    {
        $suma = self::calcularSumaPonderada($curp, 17);
        $residuo = $suma % 10;
        return $residuo == 0 ? '0' : (string)(10 - $residuo);
    }

    // Calcula la suma ponderada para homoclave y dígito verificador
    private static function calcularSumaPonderada($curp, $longitud)
    {
        $suma = 0;
        $pesos = range(18, 19 - $longitud); // Pesos de 18 a 3 o 2

        for ($i = 0; $i < $longitud; $i++) {
            $caracter = $curp[$i];
            $valor = self::$valores[$caracter] ?? 0;
            $suma += $valor * $pesos[$i];
        }

        return $suma;
    }

}