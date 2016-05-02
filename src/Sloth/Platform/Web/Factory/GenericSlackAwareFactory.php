<?php

namespace Sloth\Platform\Web\Factory;

use DMS\Standard\DI\ClassResolvingTarget;
use Interop\Container\ContainerInterface;
use Sloth\Platform\Slack\SlackClientInterface;

class GenericSlackAwareFactory extends ClassResolvingTarget
{
    public function __invoke(ContainerInterface $container)
    {
        $class = $this->getTargetName();
        return new $class($container->get(SlackClientInterface::class));
    }
}
