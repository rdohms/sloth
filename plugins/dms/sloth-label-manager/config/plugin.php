<?php

use DMS\Sloth\Plugin\Github\LabelManager\Action\NotifyLabelAction;
use Sloth\Platform\Web\Factory\GenericSlackAwareFactory;

return [
    'dms.github.label-manager' => [
        'actionable.regexp' => '/^needs.*$/'
    ],

    'dependencies' => [
        'factories' => array(
            NotifyLabelAction::class => GenericSlackAwareFactory::class
        ),
    ],

    'routes' => [
        [
            'name' => 'plugin_dms_label_notify_label',
            'path' => '/plugin/dms/label/notify',
            'middleware' => NotifyLabelAction::class,
            'allowed_methods' => ['POST'],
        ],
    ],
];
