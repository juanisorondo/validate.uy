<?php

namespace juanisorondo\ValidadorUruguay;

class Ci {

    const DOTS_HYPHEN = '(\d\.)?\d{3}\.\d{3}-\d';
    const HYPHEN = '\d{6,7}-\d';
    const NUMBERS = '\d{7,8}';

    public $format;

    public function __construct($format = null) {
        if (!$format) {
            $this->format = '(' . self::DOTS_HYPHEN . ')|(' . self::HYPHEN . ')|(' . self::NUMBERS . ')';
        }
        $this->format = $format;
    }

    public function validate($ci) {
        if (!preg_match("/$this->format/", $ci)) {
            return false;
        }

        $numbers = str_replace(['.', '-'], '', $ci);
        $numbers = strlen($numbers) == 7 ? "0$numbers" : $numbers;
        
        $split = str_split($numbers);
        $coeffs = [2, 9, 8, 7, 6, 3, 4, 1];
        
        $prod = array_map(function($int, $coeff) {
            return $int * $coeff;
        }, $split, $coeffs);

        return array_sum($prod) % 10 == 0;
    }

}
