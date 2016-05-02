<?php

namespace Sloth\Platform\Slack\Message;

class Field
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $value;

    /**
     * @var bool
     */
    public $short = false;

    /**
     * @param      $title
     * @param      $value
     * @param bool $short
     *
     * @return static
     */
    public static function fromParts($title, $value, $short = false)
    {
        $instance = new static();
        $instance->title = $title;
        $instance->value = $value;
        $instance->short = $short;

        return $instance;
    }
}
