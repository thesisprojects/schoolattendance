<?php
/**
 * Created by PhpStorm.
 * User: Keannu
 * Date: 10/12/2017
 * Time: 4:13 PM
 */

namespace App\Classes;

class DateHelper
{
    public static function getDay($date)
    {
        $dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $dateArray = explode(',', $date);
        $dateNamesArray = [];

        foreach ($dateArray as $date) {
            array_push($dateNamesArray, $dowMap[$date]);
        }

        return $dateNamesArray;
    }
}