<?php
namespace App\CCPortal\Classes\Helpers;

class ArrayHelpers
{
    public static function getValuesContainsKey($array, $requriedKey)
    {
        $array = array_filter($array, function($key) use ($requriedKey) {
            return strpos($key, $requriedKey) === 0;
        }, ARRAY_FILTER_USE_KEY);

        return array_values($array);
    }
}