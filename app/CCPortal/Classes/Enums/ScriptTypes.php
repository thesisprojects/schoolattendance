<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017-08-02
 * Time: 6:21 PM
 */

namespace App\CCPortal\Classes\Enums;


abstract class ScriptTypes
{
    const Survey = "SURVEYS";
    const Hotkey = "HOTKEYS";
    const Dropdown = [
        ScriptTypes::Survey,
        ScriptTypes::Hotkey
    ];

}