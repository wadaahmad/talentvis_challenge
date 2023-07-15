<?php

namespace helper;

class RouterHelper
{
    public static function redirect($url)
    {
        header("Location:$url");

        // No need javascript
        // echo "
        // <script>
        //     window.location.href = '$url';
        // </script>
        // ";
    }
}
