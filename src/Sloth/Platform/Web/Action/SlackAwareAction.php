<?php

namespace Sloth\Platform\Web\Action;

use Sloth\Platform\Slack\SlackClientInterface;

abstract class SlackAwareAction
{
    protected $slack;

    /**
     * SlackAwareAction constructor.
     *
     * @param SlackClientInterface $slack
     */
    public function __construct(SlackClientInterface $slack)
    {
        $this->slack = $slack;
    }

    /**
     * @return SlackClientInterface
     */
    public function getSlack()
    {
        return $this->slack;
    }

}
