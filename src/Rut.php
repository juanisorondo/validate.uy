<?php

namespace juanisorondo\ValidadorUruguay;

class Rut
{
    public static function validate($rut)
    {
        if (strlen($rut) != 12 || !is_numeric($rut)) {
            return false;
        }
        $rut = strval($rut);

        $primerosDosDigitos = intval(substr($rut, 0, 2));

        if ($primerosDosDigitos < 1 || $primerosDosDigitos > 21) {
            return false;
        }

        $digitos3Al8SonCeros = substr($rut, 2, 6) === '000000';
        $digitos9Al10SonCeros = substr($rut, 8, 2) === '00';

        if ($digitos3Al8SonCeros || !$digitos9Al10SonCeros) {
            return false;
        }

        $tmp = array_map('intval', str_split($rut));

        $tmp = array_map(function ($x, $y) {
            return $x * $y;
        }, array_slice($tmp, 0, 11), [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);

        $tmp = array_sum($tmp);

        $digito_verificador = 11 - $tmp % 11;
        if ($digito_verificador == 11) {
            $digito_verificador = 0;
        }
        
        return $rut[11] == $digito_verificador;
    }
}
