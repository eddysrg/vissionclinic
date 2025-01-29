<?php

namespace App\Services;

/**
 * Service to generate CURP.
 *
 * This service allows you to generate the CURP from a person's general data.
 *
 * @package App\Services
 */

class CurpGenerator
{
    /**
     * Generates the CURP and returns the result.
     *
     * @param string $name The name of the person.
     * @param string $fatherLastName The person's paternal surname.
     * @param string $motherLastName The person's maternal surname.
     * @param string $gender The gender of the person.
     * @param string $birthdate The date of birth of the person.
     * @param string $birthplace The place of birth of the person.
     * @return bool Returns the generated curp.
     */
    public static function generateCurp(string $name, string $fatherLastName, string $motherLastName, string $gender, string $birthdate, string $birthplace)
    {
        // We convert the data to uppercase to comply with the CURP format
        $name = strtoupper($name);
        $fatherLastName = strtoupper($fatherLastName);
        $motherLastName = strtoupper($motherLastName);
        $gender = strtoupper($gender);
        $birthplace = strtoupper($birthplace);

        // Get the first letter and the first internal vowel of the paternal surname
        $curp = substr($fatherLastName, 0, 1);
        $curp .= self::getFirstInternalVowel($fatherLastName);

        // First letter of the mother's surname and first letter of the first name
        $curp .= substr($motherLastName, 0, 1);
        $curp .= substr($name, 0, 1);

        // Date of birth in YYMMDD format
        $curp .= substr($birthdate, 2, 2);
        $curp .= substr($birthdate, 5, 2);
        $curp .= substr($birthdate, 8, 2);

        // Gender (M for male, M for female)
        $curp .= $gender;

        // Federal entity code
        $curp .= $birthplace;

        // First internal consonant of the paternal and maternal surnames and first name
        $curp .= self::getFirstInternalConsonant($fatherLastName);
        $curp .= self::getFirstInternalConsonant($motherLastName);
        $curp .= self::getFirstInternalConsonant($name);
        
        return $curp;
    }

    public static function getFirstInternalVowel($str)
    {
        for ($i = 1; $i < strlen($str); $i++) {
            if (in_array($str[$i], ['A', 'E', 'I', 'O', 'U'])) {
                return $str[$i];
            }
        }
        return 'X';
    }

    public static function getFirstInternalConsonant($str)
    {
        for ($i = 1; $i < strlen($str); $i++) {
            if (!in_array($str[$i], ['A', 'E', 'I', 'O', 'U']) && ctype_alpha($str[$i])) {
                return $str[$i];
            }
        }

        return 'X';
    }
}