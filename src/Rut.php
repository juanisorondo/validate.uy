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

        $tmp = array_map('intval', str_split($rut));

        $tmp = array_map(function ($x, $y) {
            return $x * $y;
        }, array_slice($tmp, 0, 11), [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);

        $tmp = array_sum($tmp);

        $digito_verificador = 11 - $tmp % 11;
        if($digito_verificador == 11){
            $digito_verificador = 0;
        }elseif($digito_verificador == 10){
            $digito_verificador = 1;
        }
        return $rut[11] == $digito_verificador;
    }
}