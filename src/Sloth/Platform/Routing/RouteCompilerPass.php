<?php

namespace Sloth\Platform\Routing;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RouteCompilerPass
 */
class RouteCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $application = $container->getDefinition('app.platform');

        foreach ($container->findTaggedServiceIds('route') as $id => $routes) {

            $reference = new Reference($id);

            foreach ($routes as $route) {
                $application->addMethodCall(
                    'route',
                    [
                        $route['path'],
                        isset($route['invoke']) ? [$reference, $route['invoke']] : $id,
                        isset($route['methods']) ? explode(',', $route['methods']) : null,
                        isset($route['id']) ? $route['id'] : null,
                    ]
                );
            }
        }

    }
}
