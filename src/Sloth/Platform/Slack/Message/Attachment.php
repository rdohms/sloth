<?php

namespace Sloth\Platform\Slack\Message;

class Attachment
{

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $pretext;

    /**
     * @var string
     */
    public $color;

    /**
     * @var array | Field[]
     */
    public $fields = [];

    /**
     * @var string
     */
    public $authorName;

    /**
     * @var string
     */
    public $authorLink;

    /**
     * @var string
     */
    public $authorIcon;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $titleLink;

    /**
     * @var string
     */
    public $imageUrl;

    /**
     * @var string
     */
    public $thumbUrl;

    /**
     * @var string
     */
    public $mrkdwnIn;

    /**
     * @var string
     */
    public $fallback;

}
