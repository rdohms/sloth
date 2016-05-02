<?php

use DMS\Sloth\Plugin\Github\LabelManager\Action\NotifyLabelAction;
use Sloth\Platform\Web\Factory\GenericSlackAwareFactory;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
            App\Action\PingAction::class => App\Action\PingAction::class,
        ],
        'factories' => array(
            App\Action\HomePageAction::class => App\Action\HomePageFactory::class,
            NotifyLabelAction::class         => GenericSlackAwareFactory::class
        ),
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => App\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'plugin_dms_label_notify_label',
            'path' => '/plugin/dms/label/notify',
            'middleware' => NotifyLabelAction::class,
            'allowed_methods' => ['POST'],
        ],
    ],
];
