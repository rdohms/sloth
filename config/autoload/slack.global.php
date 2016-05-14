<?php
return [
    'slack_config' => getenv('SLACK_URL'),

    'dependencies' => [
        'factories' => [
            \Sloth\Platform\Slack\SlackClientInterface::class => \Sloth\Platform\Slack\Driver\Phlack\Factory::class,
        ],
    ],
];
