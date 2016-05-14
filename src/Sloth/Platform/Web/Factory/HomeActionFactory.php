<?php

namespace Sloth\Platform\Web\Factory;

use Interop\Container\ContainerInterface;
use Sloth\Platform\Web\Action\HomeAction;

/**
 * Class HomeActionFactory
 */
class HomeActionFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return HomeAction
     */
    public function __invoke(ContainerInterface $container)
    {
        return new HomeAction($container);
    }
}
