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
     * AttachmentBuilder constructor.
     */
    public function __construct()
    {
        $this->attachment = new Attachment();
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->attachment->text = $text;
        return $this;
    }

    /**
     * @param $pretext
     *
     * @return $this
     */
    public function setPretext($pretext)
    {
        $this->attachment->pretext = $pretext;
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
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->attachment->title = $title;
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
     */
    public function addField($title, $value, $short = false)
    {
        $this->attachment->fields[] = Field::fromParts($title, $value, $short);
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
}
