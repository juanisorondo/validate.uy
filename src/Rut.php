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

        if ($primerosDosDigitos < 1 || $primerosDosDigitos > 22) {
            return false;
        }

        if (substr($rut, 2, 6) == 0) {
            return false;
        }

        if (substr($rut, 8, 2) != 0) {
            return false;
        }

        $tmp = array_map('intval', str_split($rut));

        $tmp = array_slice($tmp, 0, 11);
        $verificadores = [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $tmp = array_map(fn ($x, $y) => $x * $y, $tmp, $verificadores);

        $tmp = array_sum($tmp);

        $digito_verificador = 11 - $tmp % 11;
        if ($digito_verificador == 11) {
            $digito_verificador = 0;
        } elseif ($digito_verificador == 10) {
            return false;
        }

        return $rut[11] == $digito_verificador;
    }
}
