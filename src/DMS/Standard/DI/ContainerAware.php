<?php


namespace DMS\Standard\DI;

use Interop\Container\ContainerInterface;

interface ContainerAware
{
    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container);

    /**
     * @return ContainerInterface
     */
    public function getContainer();
}
