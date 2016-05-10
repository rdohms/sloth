<?php

namespace Sloth\Plugin\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sloth\Platform\Slack\SlackClientInterface;

/**
 * Interface SlackActionInterface
 */
interface SlackActionInterface
{

    /**
     * @return SlackClientInterface
     */
    public function getSlack();

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null);
}
