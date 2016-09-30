<?php

namespace Sloth\Platform\Web\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class HomeAction
{

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $config = [];//$this->container->get('config');

//        $data = [
//            'is_slack_configured' => $config['slack_config'] ? true : false,
//            'loaded_plugins'      => $config['loaded_plugins']
//        ];

        $data = [];

        return new JsonResponse($data);
    }

}
