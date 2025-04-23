<?php

namespace juanisorondo\ValidadorUruguay;

class Ci
{
    const DOTS_HYPHEN = '(\d\.)?\d{1,3}\.\d{3}-\d';
    const HYPHEN = '\d{5,7}-\d';
    const NUMBERS = '\d{5,8}';

    public static function validate(string $ci, string $format = null) : bool
    {
        if (!$format) {
            $format = '(' . self::DOTS_HYPHEN . ')|(' . self::HYPHEN . ')|(' . self::NUMBERS . ')';
        }
        
        if (!preg_match("/$format/", $ci)) {
            return false;
        }

        $numbers = str_replace(['.', '-'], '', $ci);
        if (!intval($numbers) || strlen($numbers) > 8) {
            return false;
        }
        $numbers = str_pad($numbers, 8, '0', STR_PAD_LEFT);

        $split = str_split($numbers);
        $coeffs = [2, 9, 8, 7, 6, 3, 4, 1];

        $prod = array_map(function ($int, $coeff) {
            return $int * $coeff;
        }, $split, $coeffs);

        return array_sum($prod) % 10 == 0;
    }
}
