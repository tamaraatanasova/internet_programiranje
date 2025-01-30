<?php

namespace App\Classes;

class Redirect
{
    public static function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}
