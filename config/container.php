<?php
$autoloader = require __DIR__ . '/../vendor/autoload.php';

use Lcobucci\DependencyInjection\ContainerBuilder;
use Sloth\Platform\Routing\RouteCompilerPass;

$builder = new ContainerBuilder();

define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'dev');

if (APPLICATION_ENV === 'dev') {
    $builder->useDevelopmentMode();
}

return $builder->setParameter('app.basedir', __DIR__ . '/../')
               ->addFile(__DIR__ . '/services.xml')
               ->setDumpDir(__DIR__ . '/data/di')
               ->addPass(new RouteCompilerPass())
               ->getContainer();


//
//use Interop\Container\ContainerInterface;
//use Sloth\Platform\Config;
//
//// Load configuration
//$config = require __DIR__ . '/config.php';
//
//// Build container
//$containerBuilder = new ContainerBuilder();
//$containerBuilder->useAutowiring(false);
//$container = $containerBuilder->build();
//
//// Inject config
//$container->set('config', $config);
//$container->set('sloth_config', Config::buildFromArrayObject($config));
//
//// Inject factories
//foreach ($config['dependencies']['factories'] as $name => $object) {
//    $container->set($name, function (ContainerInterface $container) use ($object, $name) {
//        if ($container->has($object) === false) {
//            $factory = new $object();
//            $container->set($object, $factory);
//        }
//
//        $factory = $container->get($object);
//
//        if ($factory instanceof \DMS\Standard\DI\ClassResolvingTarget) {
//            $factory->injectTargetClassName($name);
//        }
//
//        return $factory($container, $name);
//    });
//}
//// Inject invokables
//foreach ($config['dependencies']['invokables'] as $name => $object) {
//    $container->set($name, function ($container) use ($object) {
//        return new $object();
//    });
//}
//
//return $container;
