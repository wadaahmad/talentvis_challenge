<?php

namespace responder;

class Responder
{

    public static function response($code, $data)
    {
        $payload = new Payload;
        $payload->code = $code;
        $payload->data = $data;
        return $payload;
    }
}
