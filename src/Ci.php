<?php

namespace juanisorondo\ValidadorUruguay;

class Ci {

    const PUNTOS_GUION = '(\d\.)?\d{3}\.\d{3}-\d';
    const GUION = '\d{6,7}-\d';
    const NUMEROS = '\d{7,8}';

    public $formato;

    public function __construct($formato = null) {
        if (!$formato) {
            $this->formato = '(' . self::PUNTOS_GUION . ')|(' . self::GUION . ')|(' . self::NUMEROS . ')';
        }
        $this->formato = $formato;
    }

    public function validar($ci) {
        if (!preg_match("/$this->formato/", $ci)) {
            return false;
        }

        $numero = str_replace(['.', '-'], '', $ci);
        $numero = strlen($numero) == 7 ? "0$numero" : $numero;
        
        $split = str_split($numero);
        $coeficientes = [2, 9, 8, 7, 6, 3, 4, 1];
        
        $prod = array_map(function($int, $coef) {
            return $int * $coef;
        }, $split, $coeficientes);

        return array_sum($prod) % 10 == 0;
    }

}
