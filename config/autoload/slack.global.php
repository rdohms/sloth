<?php
return [
    'slack_config' => "<insert your url>",

    'dependencies' => [
        'factories' => [
            \Sloth\Platform\Slack\SlackClientInterface::class => \Sloth\Platform\Slack\Driver\Phlack\Factory::class,
        ],
    ],
];
