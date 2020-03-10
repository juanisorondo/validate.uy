<?php

namespace juanisorondo\ValidadorUruguay;

class Rut
{
    public function validate($rut)
    {
        if (strlen($rut) != 12 || !is_numeric($rut)) {
            return false;
        }

        $tmp = array_map('intval', str_split($rut));

        $tmp = array_map(function ($x, $y) {
            return $x * $y;
        }, array_slice($tmp, 0, 11), [4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);

        $tmp = array_sum($tmp);

        return $rut[11] == 11 - $tmp % 11;
    }
}