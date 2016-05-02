<?php

namespace Sloth\Platform\Slack;

use Sloth\Platform\Slack\Message\Message;

interface SlackClientInterface
{
    /**
     * @param Message $message
     *
     * @return mixed
     */
    public function sendMessage(Message $message);
}
