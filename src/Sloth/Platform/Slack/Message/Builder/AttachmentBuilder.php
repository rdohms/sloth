<?php

namespace Sloth\Platform\Slack\Message\Builder;

use Sloth\Platform\Slack\Message\Attachment;
use Sloth\Platform\Slack\Message\Field;

/**
 * Class AttachmentBuilder
 */
class AttachmentBuilder
{
    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * @var MessageBuilder
     */
    protected $messageBuilder;

    /**
     * AttachmentBuilder constructor.
     *
     * @param MessageBuilder $builder
     */
    public function __construct(MessageBuilder $builder)
    {
        $this->attachment = new Attachment();
        $this->messageBuilder = $builder;
    }

    /**
     * @param           $text
     * @param string[] $vars
     *
     * @return $this
     */
    public function setText(string $text, string ...$vars)
    {
        $this->attachment->text = (empty($vars))? $text : sprintf($text, ...$vars);
        return $this;
    }

    /**
     * @param           $pretext
     *
     * @param \string[] $vars
     *
     * @return $this
     */
    public function setPretext($pretext, string ...$vars)
    {
        $this->attachment->pretext = (empty($vars))? $pretext : sprintf($pretext, ...$vars);
        return $this;
    }

    /**
     * @param $color
     *
     * @return $this
     */
    public function setColor($color)
    {
        $this->attachment->color = $color;
        return $this;
    }

    /**
     * @param $authorName
     *
     * @return $this
     */
    public function setAuthorName($authorName)
    {
        $this->attachment->authorName = $authorName;
        return $this;
    }

    /**
     * @param $authorLink
     *
     * @return $this
     */
    public function setAuthorLink($authorLink)
    {
        $this->attachment->authorLink = $authorLink;
        return $this;
    }

    /**
     * @param           $title
     *
     * @param string[] $vars
     *
     * @return $this
     */
    public function setTitle($title, string ...$vars)
    {
        $this->attachment->title = (empty($vars))? $title : sprintf($title, ...$vars);;
        return $this;
    }

    /**
     * @param $titleLink
     *
     * @return $this
     */
    public function setTitleLink($titleLink)
    {
        $this->attachment->titleLink = $titleLink;
        return $this;
    }

    /**
     * @param $imageUrl
     *
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->attachment->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * @param $thumbUrl
     *
     * @return $this
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->attachment->thumbUrl = $thumbUrl;
        return $this;
    }

    /**
     * @param $mrkdwnIn
     *
     * @return $this
     */
    public function setMrkdwnIn($mrkdwnIn)
    {
        $this->attachment->mrkdwnIn = $mrkdwnIn;
        return $this;
    }

    /**
     * @param $fallback
     *
     * @return $this
     */
    public function setFallback($fallback)
    {
        $this->attachment->fallback = $fallback;
        return $this;
    }

    /**
     * @param      $title
     * @param      $value
     * @param bool $short
     *
     * @return $this
     */
    public function addField($title, $value, $short = false)
    {
        $this->attachment->fields[] = Field::fromParts($title, $value, $short);

        return $this;
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @return MessageBuilder
     */
    public function attach()
    {
        $this->messageBuilder->addAttachment($this->getAttachment());

        return $this->messageBuilder;
    }
}
