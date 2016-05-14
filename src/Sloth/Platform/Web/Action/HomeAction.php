<?php

namespace Sloth\Platform\Web\Action;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeAction
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * HomeAction constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->template  = $container->get(TemplateRendererInterface::class);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $config = $this->container->get('config');

        $data = [
            'is_slack_configured' => $config['slack_config'] ? true : false,
            'loaded_plugins'      => $config['loaded_plugins']
        ];

        return new HtmlResponse($this->template->render('app::home', $data));
    }


}
