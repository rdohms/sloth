<?php

namespace Sloth\Platform\Slack\Driver\Phlack;

use Sloth\Platform\Slack\Message\Message;
use Sloth\Platform\Slack\SlackClientInterface;
use Crummy\Phlack\Phlack;

class Slack implements SlackClientInterface
{

    /**
     * @var Phlack
     */
    protected $client;

    /**
     * @var MessageTransformer
     */
    protected $transformer;

    /**
     * SlackInterface constructor.
     *
     * @param Phlack                                                 $client
     * @param \Sloth\Platform\Slack\Driver\Phlack\MessageTransformer $transformer
     */
    public function __construct(Phlack $client, MessageTransformer $transformer)
    {
        $this->client = $client;
        $this->transformer = $transformer;
    }

    /**
     * @param Message $message
     *
     * @return \Crummy\Phlack\Bridge\Guzzle\Response\MessageResponse|mixed
     */
    public function sendMessage(Message $message)
    {
        $payload = $this->transformer->convertMessage($message);
        $response = $this->client->send($payload);

        return $response->get('status') == 200;
    }


}
