<?php

namespace Sloth\Platform\Error;

use Whoops;
use Zend\Expressive\Container\WhoopsErrorHandlerFactory;
use Zend\Stdlib\ArrayUtils;

/**
 * Class ErrorHandlerLoader
 *
 * Configures ErrorHandling factory based on debug setting.
 * This allows us to easily switch to debug while in production, which is fair for a product that will mostly
 * run internally in companies.
 */
class ErrorHandlerLoader
{

    public static function enableErrorHandling(array $config)
    {
        if ($config['debug'] !== true) {
            return $config;
        }

        if (class_exists(Whoops\Run::class) === false) {
            return $config;
        }

        $errorConfig = [
            'dependencies' => [
                'invokables' => [
                    'Zend\Expressive\Whoops' => Whoops\Run::class,
                    'Zend\Expressive\WhoopsPageHandler' => Whoops\Handler\PrettyPageHandler::class,
                ],
                'factories' => [
                    'Zend\Expressive\FinalHandler' => WhoopsErrorHandlerFactory::class,
                ],
            ],
        ];

        return ArrayUtils::merge($config, $errorConfig);
    }

}
