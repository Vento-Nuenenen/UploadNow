<?php

namespace App\Helper;

class Helper
{
    public static function nl2br($str)
    {
        return str_replace("\n", '<br />', $str);
    }
}
