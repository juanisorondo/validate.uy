<?php

namespace juanisorondo\ValidadorUruguay;

class Ci {

    public function validate( string $ci ) : bool
    {
        $ci = preg_replace( '/\D/', '', $ci );
        $validationDigit = $ci[-1];
        $ci = preg_replace('/[0-9]$/', '', $ci );
        return $validationDigit == $this->validation_digit( $ci );
    }

    public function validation_digit( string $ci ) : int
    {
        $ci = str_pad( $ci, 7, '0', STR_PAD_LEFT );
        $a = 0;
        $baseNumber = "2987634";
        for ( $i = 0; $i < 7; $i++ ) {
            $baseDigit = $baseNumber[ $i ];
            $ciDigit = $ci[ $i ];
            $a += ( intval($baseDigit ) * intval( $ciDigit ) ) % 10;
        }
        return $a % 10 == 0 ? 0 : 10 - $a % 10;
    }
}
