<?php


namespace Sloth\Platform\Slack;

/**
 * Interface ResponseInterface
 *
 * Responses sent back from Slack
 */
interface SlackResponseInterface
{
    /**
     * @return mixed
     */
    public function isSuccessful();
}
