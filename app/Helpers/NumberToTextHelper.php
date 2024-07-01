<?php

namespace App\Helpers;

class NumberToTextHelper
{
    protected static $units = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
    protected static $teens = ["Sepuluh", "Sebelas", "Dua Belas", "Tiga Belas", "Empat Belas", "Lima Belas", "Enam Belas", "Tujuh Belas", "Delapan Belas", "Sembilan Belas"];
    protected static $tens = ["", "", "Dua Puluh", "Tiga Puluh", "Empat Puluh", "Lima Puluh", "Enam Puluh", "Tujuh Puluh", "Delapan Puluh", "Sembilan Puluh"];
    protected static $thousands = ["", "Seribu", "Juta", "Milyar", "Trilyun"];

    public static function convert($number)
    {
        if ($number < 10) {
            return self::$units[$number];
        } elseif ($number < 20) {
            return self::$teens[$number - 10];
        } elseif ($number < 100) {
            return self::$tens[intval($number / 10)] . " " . self::$units[$number % 10];
        } else {
            return (string) $number; // For numbers 100 and above, you might want to expand the logic
        }
    }
}
