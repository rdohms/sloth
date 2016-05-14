<?php
use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;
use Sloth\Platform\Config;

// Load ENV vars
if (file_exists(__DIR__ . '/../.env')) {
    $container['env'] = new \Dotenv\Dotenv(__DIR__.'/../', '.env');
    $container['env']->load();
}

// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$container = $containerBuilder->build();

// Inject config
$container->set('config', $config);
$container->set('sloth_config', Config::buildFromArrayObject($config));

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
