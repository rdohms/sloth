<?php

namespace DMS\Sloth\Plugin\Github\PullRequestManager\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sloth\Platform\Slack\Message\Builder\MessageBuilder;
use Sloth\Platform\Slack\Message\Message;
use Sloth\Platform\Web\Action\SlackAwareAction;
use Sloth\Plugin\Github\AckResponse;
use Sloth\Plugin\Web\SlackActionInterface;

/**
 * Class BroadcastPrReviewComment
 *
 * When comments are made on a PR (or issue), this action broadcasts them to Slack with more information than the
 * standard integration.
 *
 * @see https://developer.github.com/v3/activity/events/types/#issuecommentevent
 */
class BroadcastPrComment extends SlackAwareAction implements SlackActionInterface
{

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return static
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $event = $request->getParsedBody();

        // Skip if we can't handle this
        if ($this->isActionableEvent($event) === false) {
            return $next($request, $response);
        }

        $result = $this->getSlack()->sendMessage($this->buildMessage($event));

        return AckResponse::respondWith($result->isSuccessful());
    }

    /**
     * @param $event
     *
     * @return bool
     */
    protected function isActionableEvent($event)
    {
        if ($event->action !== 'created') {
            return false;
        }

        return true;
    }

    /**
     * @param $event
     *
     * @return Message
     */
    protected function buildMessage($event)
    {
        $builder = new MessageBuilder();

        $builder->setUsername("Comment on PR");
        $builder->createAttachment()
            ->setColor('#C9C9C9')
            ->setText($event->comment->body)
            ->setTitle(
                "#%s %s by %s",
                $event->issue->number,
                $event->issue->title,
                $event->issue->user->login
            )
            ->setTitleLink($event->comment->html_url)
            ->setThumbUrl($event->comment->user->avatar_url)
            ->addField("Repository", $event->repository->full_name, true)
            ->addField("Comment by", $event->comment->user->login, true)
            ->attach();

        return $builder->getMessage();
    }
}
