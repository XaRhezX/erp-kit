<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Helper
{
    public static function toArray(object $object)
    {
        return json_decode(json_encode($object), true);
    }

    public static function toObject(array $array)
    {
        return json_decode(json_encode($array));
    }

    public static function indonesiaDayName($day)
    {
        switch ($day) {
            case 1:
                $name = 'Senin';
                break;

            case 2:
                $name = 'Selasa';
                break;

            case 3:
                $name = 'Rabu';
                break;

            case 4:
                $name = 'Kamis';
                break;

            case 5:
                $name = 'Jumat';
                break;

            case 6:
                $name = 'Sabtu';
                break;

            case 7:
                $name = 'Minggu';
                break;

            default:
                $name = '';
                break;
        }

        return $name;
    }
}