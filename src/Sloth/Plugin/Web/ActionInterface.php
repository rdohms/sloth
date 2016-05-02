<?php

namespace Sloth\Plugin\Web;

use Crummy\Phlack\Phlack;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ActionInterface
{

    /**
     * @return Phlack
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
