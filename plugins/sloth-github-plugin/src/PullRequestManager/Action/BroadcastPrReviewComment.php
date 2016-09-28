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
 * When review comments are made on a PR, this action broadcasts them to Slack with more information then the standard
 * integration.
 *
 * @see https://developer.github.com/v3/activity/events/types/#pullrequestreviewcommentevent
 */
class BroadcastPrReviewComment extends SlackAwareAction implements SlackActionInterface
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
        $result = $this->getSlack()->sendMessage($this->buildMessage($event));

        return AckResponse::respondWith($result->isSuccessful());
    }



    /**
     * @param $event
     *
     * @return Message
     */
    protected function buildMessage($event)
    {
        $builder = new MessageBuilder();

        $builder->setUsername("Code Review Comment");
        $builder->createAttachment()
            ->setColor('#C9C9C9')
            ->setText(
                "%s \n\non %s: %s",
                $event->comment->body,
                $event->comment->path,
                $event->comment->position
            )
            ->setTitle(
                "#%s %s by %s",
                $event->pull_request->number,
                $event->pull_request->title,
                $event->pull_request->user->login
            )
            ->setTitleLink($event->comment->html_url)
            ->setThumbUrl($event->comment->user->avatar_url)
            ->addField("Repository", $event->repository->full_name, true)
            ->addField("Comment by", $event->comment->user->login, true)
            ->attach();

        return $builder->getMessage();
    }
}
