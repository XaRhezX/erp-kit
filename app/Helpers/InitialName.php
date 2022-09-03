<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class InitialName
{

    static public $name;

    public static function make($name, $length = 2, $uppercase = false, $ascii = false, $rtl = false)
    {
        self::setName($name, $ascii);

        $words = new Collection(explode(
            ' ',
            preg_replace(
                "/[^A-Za-z0-9.!?\s]/",
                "",
                self::$name
            )
        ));

        // if name contains single word, use first N character
        if ($words->count() === 1) {
            $initial = self::getInitialFromOneWord($words, $length);
        } else {
            $initial = self::getInitialFromMultipleWords($words, $length);
        }

        if ($uppercase) {
            $initial = strtoupper($initial);
        }

        if ($rtl) {
            $initial = collect(mb_str_split($initial))->reverse()->implode('');
        }

        return $initial;
    }

    protected static function setName($name, $ascii)
    {
        if (is_array($name)) {
            throw new \InvalidArgumentException(
                'Passed value cannot be an array'
            );
        } elseif (is_object($name) && !method_exists($name, '__toString')) {
            throw new \InvalidArgumentException(
                'Passed object must have a __toString method'
            );
        }

        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            // turn bayu.hendra@gmail.com into "Bayu Hendra"
            $name = str_replace('.', ' ', Str::before($name, '@'));
        }

        if ($ascii) {
            $name = Str::ascii($name);
        }

        self::$name = $name;
    }

    protected static function getInitialFromOneWord($words, $length)
    {
        $initial = (string)$words->first();

        if (strlen(self::$name) >= $length) {
            $initial = Str::substr(self::$name, 0, $length);
        }

        return str::upper($initial);
    }

    protected static function getInitialFromMultipleWords($words, $length)
    {
        // otherwise, use initial char from each word
        $initials = new Collection();
        $words->each(function ($word) use ($initials) {
            $initials->push(Str::substr($word, 0, 1));
        });

        return self::selectInitialFromMultipleInitials($initials, $length);
    }

    protected static function selectInitialFromMultipleInitials($initials, $length)
    {
        $initial = $initials->slice(0, $length)->implode('');
        if (Str::length($initial) < $length) {
            $rest = $length - Str::length($initial);
            $initial = $initial . substr(self::$name, $rest * -1, $rest);
        }
        return str::upper($initial);
    }
}