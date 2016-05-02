<?php

namespace Sloth\Plugin\Github;

use Zend\Diactoros\Response\JsonResponse;

class AckResponse extends JsonResponse
{
    public static function respondWith($success = true)
    {
        $instance = new static([
            'ack' => $success
        ]);

        return $instance;
    }
    
    public static function success()
    {
        return static::respondWith(true);
    }

    public static function failure()
    {
        return static::respondWith(true);
    }
}
