<?php

namespace helper;

class RouterHelper
{
    public static function redirect($url)
    {
        echo "
        <script>
            window.location.href = '$url';
        </script>
        ";
    }
}
