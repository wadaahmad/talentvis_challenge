<?php

namespace helper;

class Request
{
    public static function get($value)
    {
        return isset($_GET[$value]) ? $_GET[$value] : null;
    }
    public static function post($value)
    {
        return isset($_POST[$value]) ? $_POST[$value] : null;
    }
}
