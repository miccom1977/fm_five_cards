<?php

namespace App;

class Helpers
{
    /** Metoda pomocnicza wypisująca parametry
     * @param $sText object|array|string|int Dane do wyświetlenia
     * @return void
     */
    public static function wda(object|array|string|int $sText): void
    {
        $plik = fopen('../storage/logs/debugLog.txt', 'a+');
        if (is_array($sText) || is_object($sText)) {
            $sText = print_r($sText, true);
        } elseif (!is_string($sText) || strlen($sText) == 0) {
            $sText = var_export($sText, true);
        }
        if ($plik) {
            fwrite($plik, $sText . "\n");
            fclose($plik);
        }
    }

    public static function generateUniqueNumber(&$usedNumbers): int
    {
        do {
            $number = random_int(1, 15);
        } while (in_array($number, $usedNumbers));

        // Dodajemy wygenerowaną liczbę do tablicy użytych numerów
        $usedNumbers[] = $number;

        return $number;
    }
}
