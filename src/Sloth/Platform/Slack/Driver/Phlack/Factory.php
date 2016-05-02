<?php

namespace Sloth\Platform\Slack\Driver\Phlack;

use Crummy\Phlack\Phlack;
use Interop\Container\ContainerInterface;

class Factory
{
    /**
     * @param ContainerInterface $container
     *
     * @return Phlack
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['slack_config'] ?? [];

        $client = Phlack::factory($config);
        $transformer = new MessageTransformer($client);

        return new Slack($client, $transformer);
    }
}
