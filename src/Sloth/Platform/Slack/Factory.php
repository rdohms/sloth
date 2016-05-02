<?php

namespace Sloth\Platform\Slack;

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
        $driver = $container->get('config')['slack_driver'];
        
        return Phlack::factory($config);
    }
}
