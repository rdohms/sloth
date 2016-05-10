<?php

use DMS\Sloth\Plugin\Github\PullRequestManager\Action\BroadcastPrComment;
use DMS\Sloth\Plugin\Github\PullRequestManager\Action\BroadcastPrReviewComment;
use Sloth\Platform\Web\Factory\GenericSlackAwareFactory;

return [
    'dependencies' => [
        'factories' => [
            BroadcastPrComment::class       => GenericSlackAwareFactory::class,
            BroadcastPrReviewComment::class => GenericSlackAwareFactory::class
        ],
    ],

    'routes' => [
        [
            'name' => 'plugin_dms_pr_regular_comment',
            'path' => '/plugin/dms/pr/comment',
            'middleware' => BroadcastPrComment::class,
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'plugin_dms_pr_regular_review_comment',
            'path' => '/plugin/dms/pr/review-comment',
            'middleware' => BroadcastPrReviewComment::class,
            'allowed_methods' => ['POST'],
        ],
    ],
];
