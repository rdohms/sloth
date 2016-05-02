<?php

namespace Sloth\Platform\Slack\Driver\Phlack;

use Crummy\Phlack\Phlack;
use Sloth\Platform\Slack\Message\Message;

class MessageTransformer
{

    /**
     * @var Phlack
     */
    protected $slack;

    /**
     * MessageTransformer constructor.
     *
     * @param Phlack $slack
     */
    public function __construct(Phlack $slack)
    {
        $this->slack = $slack;
    }

    /**
     * @param Message $message
     *
     * @return \Crummy\Phlack\Message\Message
     */
    public function convertMessage(Message $message)
    {
        $builder = $this->slack->getMessageBuilder();

        $builder
            ->setChannel($message->channel)
            ->setIconEmoji($message->iconEmoji)
            ->setText($message->text)
            ->setUsername($message->username);

        foreach ($message->attachments as $attachment) {
            $attachmentBuilder = $builder->createAttachment();
            $attachmentBuilder
                ->setText($attachment->text)
                ->setPretext($attachment->pretext)
                ->setThumbUrl($attachment->thumbUrl)
                ->setTitle($attachment->title)
                ->setTitleLink($attachment->titleLink)
                ->setAuthorIcon($attachment->authorIcon)
                ->setAuthorLink($attachment->authorLink)
                ->setAuthorName($attachment->authorName)
                ->setColor($attachment->color)
                ->setFallback($attachment->fallback)
                ->setImageUrl($attachment->imageUrl)
                ->setMrkdwnIn($attachment->mrkdwnIn);

                foreach ($attachment->fields as $field) {
                    $attachmentBuilder->addField($field->title, $field->value, $field->short);
                }

            $attachmentBuilder->end();
        }

        return $builder->create();
    }
}
