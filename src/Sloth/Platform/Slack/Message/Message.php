<?php

namespace Sloth\Platform\Slack\Message;

class Message
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var array | Attachment[]
     */
    public $attachments;

    /**
     * @var string
     */
    public $channel;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $iconEmoji;

}

