<?php

namespace Sloth\Platform\Slack\Driver\Phlack;

use Crummy\Phlack\Bridge\Guzzle\Response\MessageResponse;
use Sloth\Platform\Slack\ResponseInterface;
use Sloth\Platform\Slack\SlackResponseInterface;

class Response extends MessageResponse implements SlackResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        $status = $this->get('status');
        return ($status >= 200 && $status < 400);
    }

    /**
     * @param MessageResponse $response
     *
     * @return static
     */
    public static function fromResponse(MessageResponse $response)
    {
        $instance = new static($response->getAll());
        return $instance;
    }
}
