<?php
/**
 * Created by PhpStorm.
 * User: Keannu
 * Date: 10/12/2017
 * Time: 4:13 PM
 */

namespace App\Classes;

use Nexmo\Laravel\Facade\Nexmo;

class TextMessageSender
{
    public static function sendTextMessage($to, $content)
    {
        $message = Nexmo::message()->send([
            'to' => $to,
            'from' => '@attendancesystem',
            'text' => $content
        ]);
    }
}