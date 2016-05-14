<?php

use Sloth\Platform\Web\Action\HomeAction;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => array(
            HomeAction::class => \Sloth\Platform\Web\Factory\HomeActionFactory::class,
        ),
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => HomeAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ]
    ],
];
