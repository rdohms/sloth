<?php
use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;

// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$container = $containerBuilder->build();

// Inject config
$container->set('config', $config);

// Inject factories
foreach ($config['dependencies']['factories'] as $name => $object) {
    $container->set($name, function (ContainerInterface $container) use ($object, $name) {
        if ($container->has($object)) {
            $factory = $container->get($object);
        } else {
            $factory = new $object();
            $container->set($object, $factory);
        }

        if ($factory instanceof \DMS\Standard\DI\ClassResolvingTarget) {
            $factory->injectTargetClassName($name);
        }

        return $factory($container, $name);
    });
}
// Inject invokables
foreach ($config['dependencies']['invokables'] as $name => $object) {
    $container->set($name, function ($container) use ($object) {
        return new $object();
    });
}

return $container;
