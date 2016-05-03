<?php

namespace DMS\Sloth\Plugin\Github\LabelManager\Action;

use Sloth\Platform\Slack\Message\Builder\MessageBuilder;
use Sloth\Platform\Web\Action\SlackAwareAction;
use Sloth\Plugin\Github\AckResponse;
use Sloth\Plugin\Web\ActionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class NotifyLabelAction
 *
 * This action should receive from Github a label event and broadcast it to SlackInterface.
 */
class NotifyLabelAction extends SlackAwareAction implements ActionInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return AckResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $event = $request->getParsedBody();

        // Skip if we can't handle this
        if ($this->isActionableEvent($event) === false) {
            return $next($request, $response);
        }

        $this->announceLabelEvent($event);

        return AckResponse::success();
    }

    /**
     * @param $event
     *
     * @return bool
     */
    protected function isActionableEvent($event)
    {
        if ($event->action !== 'labeled') {
            return false;
        }

        if (strpos($event->label->name, 'needs') === false) {
            return false;
        }

        return true;
    }

    /**
     * @param $event
     */
    protected function announceLabelEvent($event)
    {
        $target = $this->extractLabelTarget($event);

        $builder = new MessageBuilder();

        $builder->createAttachment()
            ->setColor('#' . $event->label->color)
            ->setTitle($event->label->name)
            ->setText(sprintf("%s by %s", $target->title, $target->user->login))
            ->setTitleLink($target->html_url)
            ->setFallback("fallback")
            ->attach();

        $builder->setUsername(sprintf("[%s] #%s", $event->repository->name, $target->number));

        $this->getSlack()->sendMessage($builder->getMessage());
    }

    /**
     * @param $event
     *
     * @return \stdClass
     */
    protected function extractLabelTarget($event)
    {
        return (isset($event->pull_request)) ? $event->pull_request : $event->issue;
    }
}
