<?php

namespace Sloth\Platform\Slack\Message\Builder;

use Sloth\Platform\Slack\Message\Attachment;
use Sloth\Platform\Slack\Message\Message;

/**
 * Class MessageBuilder
 */
class MessageBuilder
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * MessageBuilder constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * @param           $text
     *
     * @param \string[] $vars
     *
     * @return $this
     */
    public function setText($text, string ...$vars)
    {
        $this->message->text = (empty($vars))? $text : sprintf($text, ...$vars);

        return $this;
    }

    /**
     * @param $channel
     *
     * @return $this
     */
    public function setChannel($channel)
    {
        $this->message->channel = $channel;

        return $this;
    }

    /**
     * @param $emoji
     *
     * @return $this
     */
    public function setIconEmoji($emoji)
    {
        $this->message->iconEmoji = $emoji;

        return $this;
    }

    /**
     * @param $username
     *
     * @return $this
     */
    public function setUsername($username, ...$vars)
    {
        $this->message->username = (empty($vars))? $username : sprintf($username, ...$vars);

        return $this;
    }

    /**
     * @param Attachment $attachment
     *
     * @return $this
     */
    public function addAttachment(Attachment $attachment)
    {
        $this->message->attachments[] = $attachment;

        return $this;
    }

    /**
     * @return AttachmentBuilder
     */
    public function createAttachment()
    {
        return new AttachmentBuilder($this);
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

}
