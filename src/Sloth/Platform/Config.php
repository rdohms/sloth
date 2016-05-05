<?php

namespace Sloth\Platform;

use ArrayObject;

class Config extends ArrayObject
{
    /**
     * @var static
     */
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance == null) {
            static::build();
        }

        return static::$instance;
    }

    /**
     * @param array $config
     *
     * @return static
     */
    public static function build($config = [])
    {
        $instance = new static($config);

        static::$instance = $instance;

        return $instance;
    }

    /**
     * @param ArrayObject $config
     *
     * @return static
     */
    public static function buildFromArrayObject(ArrayObject $config)
    {
        $instance = new static($config->getArrayCopy());

        static::$instance = $instance;

        return $instance;
    }
}
