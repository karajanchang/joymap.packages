<?php
if (!function_exists('floor_dec')) {
    function floor_dec($value, int $decimal = 2)
    {
        $zero_word = '1';
        for($i=0; $i < $decimal; $i++){
            $zero_word.='0';
        }
        $zero = (int) $zero_word;

        return floor($value * $zero) / $zero;
    }
}