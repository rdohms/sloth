<?php

namespace DMS\Standard\DI;

use Interop\Container\ContainerInterface;

class ContainerAwareFactory extends ClassResolvingTarget
{


    public function __invoke(ContainerInterface $container)
    {
        /** @var ContainerAware $class */
        $class = new $this->targetClass();
        $class->setContainer($container);

        return $class;
    }
}
