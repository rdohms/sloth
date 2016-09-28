<?php

namespace spec\Sloth\Platform\Slack\Message\Builder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sloth\Platform\Slack\Message\Builder\AttachmentBuilder;

class MessageBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Sloth\Platform\Slack\Message\Builder\MessageBuilder');
    }

    public function it_can_receive_plaintext_text_fluently()
    {
        $this->setText("plain text")->shouldReturn($this);

        $this->getMessage()->text->shouldBe("plain text");
    }

    public function it_can_receive_sprintf_text_fluently()
    {
        $format = "%s on %s";
        $var1 = "xx";
        $var2 = "yy";

        $this->setText($format, $var1, $var2)->shouldReturn($this);

        $this->getMessage()->text->shouldBe(sprintf($format, $var1, $var2));
    }

    public function it_can_create_a_attachment_builder()
    {
        $this->createAttachment()->shouldHaveType(AttachmentBuilder::class);
    }
}
