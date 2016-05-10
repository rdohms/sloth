<?php

namespace Sloth\Plugin\Github;

use Zend\Diactoros\Response\JsonResponse;

/**
 * Class AckResponse
 *
 * Responds with a simple Ack JSON payload
 */
class AckResponse extends JsonResponse
{
    /**
     * Respond with dynamic result
     *
     * @param bool   $success
     * @param string $message
     * @return static
     */
    public static function respondWith($success = true, string $message = '')
    {
        $instance = new static([
            'ack' => $success,
            'message' => $message
        ]);

        return $instance;
    }

    /**
     * Interaction was successful
     *
     * @param string $message
     * @return AckResponse
     */
    public static function success(string $message = 'Ok!')
    {
        return static::respondWith(true, $message);
    }

    /**
     * Interaction failed
     *
     * @param string $message
     * @return AckResponse
     */
    public static function failure(string $message = '')
    {
        return static::respondWith(true, $message);
    }
}
